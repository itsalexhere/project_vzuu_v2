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
      label: "My Dataset",
      backgroundColor: "pink",
      borderColor: "pink",
      data: [20, 10, 55, 56, 190], 
      fill: false, 
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
  type: "bar",
  data: data12,
  options: {
    plugins: {
      title: {
        display: false,
      },
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

var colors = ["#f7cac9", "#a2836e"];
const labels2 = ["Female", "Male"];

const data2 = {
  labels: labels2,
  datasets: [
    {
      data: [80, 20],
      backgroundColor: colors,
      borderColor: colors,
      borderWidth: 2,
      hoverOffset: 4,
    },
  ],
};

const dounut1 = {
  type: "doughnut",
  data: data2,
  options: {
    cutout: "80%",
    responsive: true,
    plugins: {

      // 🔥 INI YANG PENTING
      datalabels: {
        color: "#fff",
        font: {
          weight: "bold",
          size: 12,
          family: fontFamily,
        },
        anchor: "center",
        align: "center",
        clamp: true,
        formatter: (value, ctx) => {
          const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
          const percent = (value / total) * 100;
          return percent < 5 ? "" : percent.toFixed(0) + "%";
        }

      },

      title: {
        display: true,
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
  },
};

var colorLables1 = ["#f7cac9", "#a2836e","#F54927"];
const labels3 = ["28 - 30", "30 - 40","> 40"];

const data3 = {
  labels: labels3,
  datasets: [
    {
      data: [40, 50,10],
      backgroundColor: colorLables1,
      borderColor: colorLables1,
      borderWidth: 2,
      hoverOffset: 4,
    },
  ],
};

const dounut2 = {
  type: "doughnut",
  data: data3,
  options: {
    cutout: "70%", 
    plugins: {
      title: {
        display: true,
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
  },
  defaults: {
    global: {
      defaultFont: fontFamily,
    },
  },
};

const labels4 = ["VIP", "Loyal","Inactive"];

const data4 = {
  labels: labels4,
  datasets: [
    {
       data: [30, 30,40],
      backgroundColor: colorLables1,
      borderColor: colorLables1,
      borderWidth: 2,
      hoverOffset: 4,
    },
  ],
};

const dounut3 = {
  type: "doughnut",
  data: data4,
  options: {
    cutout: "70%", 
    plugins: {
      title: {
        display: true,
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
  },
  defaults: {
    global: {
      defaultFont: fontFamily,
    },
  },
};

var myChart = new Chart($('#kt_chartjs_2'), config);
var myChart2 = new Chart($('#kt_chartjs_3'), config);
var myChart3 = new Chart($('#kt_chartjs_donut1'), dounut1);
var myChart4 = new Chart($('#kt_chartjs_donut2'), dounut2);
var myChart5 = new Chart($('#kt_chartjs_donut3'), dounut3);


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