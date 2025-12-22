var fontFamily = KTUtil.getCssVariableValue("--bs-font-sans-serif");

// Chart labels
const labels1 = ["2021", "2022", "2023", "2024", "2025"];
const labels = ["2021", "2022", "2023", "2024", "2025"];

// Chart data
const data = {
  labels: labels1,
  datasets: [
    {
      label: "My Dataset",
      backgroundColor: "pink",
      borderColor: "pink",
      data: [40, 60, 55, 56, 120], 
      fill: false, 
    },
  ],
};

const data12 = {
  labels: labels,
  datasets: [
    {
      backgroundColor: "orange",
      borderColor: "orange",
      data: [180, 80, 55, 56, 100], 
      tension: 0.4
    },
  ],
};

const config = {
  type: "line",
  data: data,
  options: {
    plugins: {
      title: {
        display: false,
      },
      legend: {
      display: false
    }
    },
    responsive: true,
    interaction: {
      intersect: false,
    },
    scales: {
      x: {
        stacked: false,
        grid: {
          display: false, // Disable grid lines for the x-axis
        },
      },
      y: {
        stacked: false,
        grid: {
          display: true, // Enable grid lines for the y-axis
        },
      },
    },
  },
  defaults: {
    global: {
      defaultFont: fontFamily,
    },
  },
};

const config2 = {
  type: "line",
  data: data12,
  options: {
    plugins: {
      title: {
        display: false,
      },
      legend: {
      display: false
    }
    },
    responsive: true,
    interaction: {
      intersect: false,
    },
    scales: {
      x: {
        stacked: false,
        grid: {
          display: false, // Disable grid lines for the x-axis
        },
      },
      y: {
        stacked: false,
        grid: {
          display: true, // Enable grid lines for the y-axis
        },
      },
    },
  },
  defaults: {
    global: {
      defaultFont: fontFamily,
    },
  },
};

createDonutChart("kt_chartjs_donut1", {
  labels: ["Female", "Male"],
  data: [70, 30],
  colors: ["#f7cac9", "#a2836e"],
  showLegend: false,
  radius: "70%",
});

createDonutChart("kt_chartjs_donut2", {
  labels: ["28 - 30", "30 - 40","> 40"],
  data: [40, 50,10],
  colors: ["#f7cac9", "#a2836e","#F54927"],
  showLegend: false,
  radius: "70%",
});

createDonutChart("kt_chartjs_donut3", {
  labels: ["VIP", "Loyal","Inactive"],
  data: [30, 30,40],
  colors: ["#f7cac9", "#27F546","#F54927"],
  showLegend: false,
  radius: "70%",
});

var myChart = new Chart($('#kt_chartjs_2'), config);
var myChart2 = new Chart($('#kt_chartjs_3'), config2);

const labelbar = ["Treatment 1", "Treatment 2","Treatment 3","Treatment 4"];

const databar = {
  labels: labelbar,
  datasets: [
    {
      label: "Sessions by Device Type",
      data: [10,20, 30,40],
      backgroundColor: ["#f7cac9", "#a2836e","#F54927","#27E845"],
      borderColor: ["#f7cac9", "#a2836e","#F54927","#27E845"],
      borderWidth: 2,
      hoverOffset: 4,
    },
  ],
};

const chartbar = {
  type: "bar",
  data: databar,
  options: {
    indexAxis: 'y',

    plugins: {
      title: {
        display: true,
        text: "Sessions by Device Type",
        padding: {
          top: 10,
          bottom: 30,
        },
        color: "#6e6b7b",
        font: {
          size: 16,
          family: fontFamily,
        },
      },
      legend: {
        display: true,
        position: "right",
        labels: {
          usePointStyle: true,
          boxWidth: 6,
          pointStyleWidth: 14,
          padding: 15,
          font: {
            size: 12,
            family: fontFamily,
          },
          color: "#6e6b7b",
        },
      },
    },

    responsive: true,
    maintainAspectRatio: false,
  },
};

var setChartBar = new Chart($('#kt_chartjs_barright'), chartbar);