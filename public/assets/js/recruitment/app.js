const API_WEBSITE = "http://192.168.5.87/website";

const processList = [
  {
    id: 0,
    bg_color: "",
    next_status: 1,
    next_status_name: "Calling/Feedback",
    statusid: [],
    liOptions: [],
  },
  {
    id: 1,
    bg_color: "bg-secondary",
    next_status: 2,
    stop_status: 1,
    next_status_name: "Interview HR",
    statusid: [1],
    liOptions: ["ok", "nok"],
  },
  {
    id: 2,
    bg_color: "bg-info",
    next_status: 4,
    stop_status: 3,
    next_status_name: "Interview User",
    statusid: [2, 3],
    liOptions: ["ok", "nok"],
  },
  {
    id: 3,
    bg_color: "bg-primary",
    next_status: 7,
    stop_status: 6,
    next_status_name: "Offering",
    statusid: [4, 5, 6],
    liOptions: ["ok", "nok", "consider"],
  },
  {
    id: 4,
    bg_color: "bg-success",
    next_status: 9,
    stop_status: 8,
    next_status_name: "Join",
    statusid: [7],
    liOptions: ["ok", "nok"],
  },
  {
    id: 5,
    bg_color: "bg-dark",
    next_status: undefined,
    stop_status: undefined,
    next_status_name: undefined,
    statusid: [8],
    liOptions: [],
  },
  {
    id: 6,
    bg_color: "bg-success",
    next_status: undefined,
    stop_status: undefined,
    next_status_name: undefined,
    statusid: [9],
    liOptions: [],
  },
];

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function formatDate(dateString) {
  let date = new Date(dateString);
  var options = { day: "numeric", month: "numeric", year: "numeric" };
  return date.toLocaleDateString("id-ID", options);
}

async function viewDoc(props) {
  const { id, name } = props;
  const apiUrl = `${API_WEBSITE}/api/employee/${id}/${name}`;
  await fetch(apiUrl, {
    method: "GET",
    // mode:'no-cors',
    headers: {
      Authorization: `Bearer ${getCookie("X-WPG-Recruitment")}`,
    },
  })
    .then((response) => {
      // console.log(response)
      if (!response.ok) {
        throw new Error(`Tidak ada dokumen ${name}`);
      }
      return response.blob();
    })
    .then((blob) => {
      const url = window.URL.createObjectURL(blob);
      const newTab = window.open(url, "_blank");
      newTab.focus();
    })
    .catch((error) => {
      console.error("Error:", error.message);
      alert(error.message);
    });
}

async function viewPhoto(props) {
  const { id } = props;
  const apiUrl = `${API_WEBSITE}/api/employee/${id}/photo`;
  await fetch(apiUrl, {
    method: "GET",
    headers: {
      Authorization: `Bearer ${getCookie("X-WPG-Recruitment")}`,
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Photo not found!");
      }
      return response.blob();
    })
    .then((blob) => {
      const url = window.URL.createObjectURL(blob);
      const newTab = window.open(url, "_blank");
      newTab.focus();
    })
    .catch((error) => {
      console.error("Error:", error.message);
      alert(error.message);
    });
}

async function processRecruitment(props) {
  fetch("../../e-recruitment/process", {
    method: "POST",
    headers: {
      Authorization: `Bearer ${getCookie("X-WPG-Recruitment")}`,
      "Content-Type": "application/json",
    },
    body: JSON.stringify(props),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status == "failed")
        return Swal.fire("Error process!", data.message, "warning");

      Swal.fire("Success", data.message, data.status).then((res) => {
        return window.location.reload();
      });
    });
}
