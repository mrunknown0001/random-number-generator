<html lang="en">
    <head>
        <title>View Winners</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css') }}">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>
        <style>

            body {
              font-family: monospace;
            }

            td, th {
              text-align: center;
            }
        </style>

    </head>

    <body>
      <div class="container">
        <h1>BGC Family Lucky Winners</h1>
        <p>
          <button class="btn btn-primary btn-sm" onclick="reloadTable()">Reload</button>
        </p>
        <table id="winners">
          <thead>
            <th>ID</th>
            <th>Winning Number</th>
            <th>Lucky Winner</th>
            <th>Prize</th>
            <th>Action</th>
          </thead>
          <tfoot>
            <th>ID</th>
            <th>Winning Number</th>
            <th>Lucky Winner</th>
            <th>Prize</th>
            <th>Action</th>
          </tfoot>
        </table>
      </div>

      <script>
        $(document).ready( function () {
            $('#winners').DataTable({
              ajax: {
                url: '/winners',
                dataSrc: ''
              },
              columns: [
                { data: 'id' },
                { data: 'number' },
                { data: 'winner' },
                { data: 'prize' },
                { data: 'action' }
              ]
            });
        });



        function updateInfo($id) {
          var winner = prompt('Please Enter Winner', '');

          // save to database
          $.ajax({
            url: '/add-winner/' + $id + '/' + winner,
            type: "get"
          });


          var prize = prompt('Please Enter Prize', '');

          $.ajax({
            url: '/add-prize/' + $id + '/'  + prize,
            type: "get"
          });

          // reload data datables
          var table = $('#winners').DataTable();
          table.ajax.reload();

        }


        function reloadTable() {
          var table = $('#winners').DataTable();
          table.ajax.reload();
        }
      </script>
    </body>
</html>