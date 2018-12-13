<html>
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
      </script>
    </body>
</html>