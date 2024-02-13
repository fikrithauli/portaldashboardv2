<!DOCTYPE html>
<html>

<head>
   <title>Visualisasi Tableau</title>
   <script src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script>
</head>

<body>
   <div id="tableauViz"></div>

   <script>
      function initViz() {
         var containerDiv = document.getElementById("tableauViz");
         var url = "https://public.tableau.com/views/foo/Bar"; // Ganti dengan URL visualisasi Anda
         var options = {
            hideTabs: true,
            width: "800px",
            height: "600px"
         };
         var trustedTicket = "{{ $trustedTicket }}"; // Ambil trusted ticket dari controller

         url = url + "?ticket=" + trustedTicket; // Tambahkan trusted ticket ke URL

         var viz = new tableau.Viz(containerDiv, url, options);
      }
      initViz();
   </script>
</body>

</html>