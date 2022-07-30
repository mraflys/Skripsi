let form = document.getElementById("form-absen")

const form_popup = () =>{
    form.style.display = "flex"
    console.log("test")
}

const close_form = () =>{
    console.log("tutup")
    form.style.display = "none"
}

google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Copper", 8.94, "#4D91DA"],
        ["Silver", 10.49, "#4D91DA"],
        ["Gold", 19.30, "#4D91DA"],
        ["Platinum", 21.45, "#4D91DA"],
        ["Copper", 8.94, "#4D91DA"],
        ["Silver", 10.49, "#4D91DA"],
        ["Gold", 19.30, "#4D91DA"],
        ["Platinum", 21.45, "#4D91DA"]
      ]);
      //Variabel, Ukuran, Warna

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Density of Precious Metals, in g/cm^3",
        width: 1500,
        height: 800,
        position: "50%",
        bar: {groupWidth: "60%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }