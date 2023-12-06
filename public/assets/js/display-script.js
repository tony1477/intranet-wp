setInterval(showTime, 1000);

// Defining showTime funcion
function showTime() {
  // Getting current time and date
  let time = new Date();
  let hour = time.getHours();
  let min = time.getMinutes();
  let sec = time.getSeconds();
  am_pm = "AM";

  // Setting time for 12 Hrs format
  if (hour >= 12) {
    if (hour > 12) hour -= 12;
    am_pm = "PM";
  } else if (hour == 0) {
    hr = 12;
    am_pm = "AM";
  }

  hour = hour < 10 ? "0" + hour : hour;
  min = min < 10 ? "0" + min : min;
  sec = sec < 10 ? "0" + sec : sec;

  let currentTime = `${hour}:${min}:${sec} ${am_pm}`;

  // Displaying the time
  document.getElementById("clock").innerHTML = currentTime;
}

showTime();

document.addEventListener("DOMContentLoaded", function (event) {
  console.log("fully loaded");
  let noEvent = 1;
  let noEmployee = 1;
  let noGallery = 1;
  const scrollEvents = function () {
    const scrollList = document.querySelector("#ulMeeting");
    const listItems = scrollList.querySelectorAll("li");
    const maxli = listItems.length;

    if (maxli == noEvent) {
      noEvent = 1;
      return (scrollList.style.transform = `translateY(0px)`);
    }

    let position = -noEvent * 80.8;
    // console.log(position)
    scrollList.style.transform = `translateY(${position}px)`;
    noEvent++;
  };
  const scrollEmployees = function () {
    const scrollList = document.querySelector(".list-group");
    const listItems = scrollList.querySelectorAll(".list-group-item");
    const maxli = listItems.length;

    if (maxli == noEmployee) {
      noEmployee = 1;
      return (scrollList.style.transform = `translateY(0px)`);
    }

    let position = -noEmployee * 106;
    // console.log(position)
    scrollList.style.transform = `translateY(${position}px)`;
    noEmployee++;
  };
  const slideGalleries = function () {
    const scrollList = document.querySelector(".auto-slider__content");
    const listItems = scrollList.querySelectorAll(".photo-gallery");
    const maxli = listItems.length;

    if (maxli == noGallery) {
      noGallery = 1;
      return (scrollList.style.transform = `translateX(0px)`);
    }

    let position = -noGallery * 318;
    // console.log(position)
    scrollList.style.transform = `translateX(${position}px)`;
    noGallery++;
  };
  setInterval(scrollEmployees, 3000);
  setInterval(scrollEvents, 3000);
  setInterval(slideGalleries, 3000);
});
