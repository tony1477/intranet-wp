const reportButton = document.querySelector(".generate-report");

const getReportFill = async (type) => {
  const reportTypeField = document.querySelector("#reporttype");
  const reportType = reportTypeField.value;
  const locationField = document.querySelector("#location");
  const location = locationField.value;
  const categoryField = document.querySelector("#category");
  const category = categoryField.value;
  const responderField = document.querySelector("#responder");
  const responder = responderField.value;

  const startDateField = document.querySelector("input[name='startdate']");
  const endDateField = document.querySelector("input[name='enddate']");
  if (startDateField.value == "" || endDateField.value == "") {
    Swal.fire("Warning", "Tanggal Harus dipilih", "info");
    return {};
  }
  const startDate = startDateField.value;
  const endDate = endDateField.value;
  return {
    reportType,
    location,
    category,
    responder,
    startDate,
    endDate,
    type,
  };
};

const generate = (el) => {
  const type = el.dataset.type;
  processReport(type);
};
const processReport = async (type) => {
  try {
    const data = await getReportFill(type);
    if (!data.hasOwnProperty("reportType")) return;
    // const { reportType, location, category, responder, startDate, endDate } =
    //   data;
    let url = "report-helpdesk/generate";
    const queryString = new URLSearchParams(data).toString();
    url += `?${queryString}`;
    // console.log((url += `?${queryString}`));

    // fetch(url, {
    //   method: "POST",
    //   mode: "same-origin",
    //   cache: "no-cache",
    //   body: JSON.stringify(data),
    // })
    //   .then((resp) => resp.json())
    //   .then((data) => {
    //     console.log(data);
    //   });
    window.open(url, "_ blank");
  } catch (e) {
    console.log(`error happen : ${e.messsage}`);
  }
};
