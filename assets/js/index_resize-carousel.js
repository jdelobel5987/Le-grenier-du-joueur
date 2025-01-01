/////////////////////////////////////////////////////////////////////////////////////
///// set carousel image width class (w-75 w-50 w-25) according to screen size /////
/////////////////////////////////////////////////////////////////////////////////////

let thresholdMobile = 500; // 320; 375; 425; 768; 1024; 1440;
let thresholdDesktop = 1000; // 320; 375; 425; 768; 1024; 1440;

// select all images within the carousel
const carImg = document.querySelectorAll(".carousel-inner img");

// set img width based on current screen size (will do on page load)
let screenWidth = window.innerWidth;

carImg.forEach((img) => {
  if (screenWidth <= thresholdMobile) {
    img.classList.add("w-75");
  } else if (screenWidth <= thresholdDesktop) {
    img.classList.add("w-50");
  } else {
    img.classList.add("w-25");
  }
});

value =
  screenWidth <= thresholdMobile
    ? "carousel img width set to w-75"
    : screenWidth <= thresholdDesktop
    ? "carousel img width set to w-50"
    : "carousel img width set to w-25";
console.log(`screen width: ${screenWidth} px
    ${value}`);

// create a function to create an array of values between initial and resized screenWidth values
function createRange(x, y) {
  let len = Math.abs(x - y) + 1;
  let arr = new Array(len);
  for (let i = 0; i < len; i++) {
    arr[i] = Math.min(x, y) + i;
  }
  return arr;
}

// create a function to change the width of images only if screen size change around the selected thresholds
function handleResize() {
  let newScreenWidth = window.innerWidth;
  console.log(`previous screen width: ${screenWidth} px`);
  console.log(`current screen width: ${newScreenWidth} px`);

  // call the array function with actual values
  let deltaWidth = createRange(screenWidth, newScreenWidth);

  // algorith for carousel images width class change

  if (deltaWidth.includes(thresholdMobile || thresholdDesktop)) {
    carImg.forEach((img) => {
      if (screenWidth <= thresholdMobile) {
        img.classList.remove("w-75");
        if (newScreenWidth <= thresholdDesktop) {
          img.classList.add("w-50");
        } else {
          img.classList.add("w-25");
        }
      } else if (screenWidth <= thresholdDesktop) {
        img.classList.remove("w-50");
        if (newScreenWidth <= thresholdMobile) {
          img.classList.add("w-75");
        } else {
          img.classList.add("w-25");
        }
      } else {
        img.classList.remove("w-25");
        if (newScreenWidth <= thresholdMobile) {
          img.classList.add("w-75");
        } else {
          img.classList.add("w-50");
        }
      }
    });
  }

  // update the screen width variable for next resize event check
  screenWidth = newScreenWidth;
}

// apply the function when the screen is resized
window.addEventListener("resize", handleResize);

// handleResize();

///////////////////////////////////////////////////////////////////////////////

// // 1st version of algorithm for carousel images width class change
// if (screenWidth <= thresholdMobile && newScreenWidth > thresholdMobile) {
//     carImg[i].classList.remove("w-75");
//     if (newScreenWidth <= thresholdDesktop) {
//       carImg[i].classList.add("w-50");
//     } else {
//       carImg[i].classList.add("w-25");
//     }
//     console.log("carousel img width set to w-100");
//   } else if (screenWidth > threshold && newScreenWidth <= threshold) {
//     carImg[i].classList.add("w-75");
//     carImg[i].classList.remove("w-100");
//     console.log("carousel img width set to w-75");
//   }

// // verion with 2 screen width thresholds ans using for loops
// for (let i = 0; i < carImg.length; i++) {
//   if (screenWidth <= thresholdMobile) {
//     carImg[i].classList.add("w-75");
//   } else if (screenWidth <= thresholdDesktop) {
//     carImg[i].classList.add("w-50");
//   } else {
//     carImg[i].classList.add("w-25");
//   }
// }

// if (deltaWidth.includes(thresholdMobile || thresholdDesktop)) {
//   for (let i = 0; i < carImg.length; i++) {
//     if (screenWidth <= thresholdMobile) {
//       carImg[i].classList.remove("w-75");
//       if (newScreenWidth <= thresholdDesktop) {
//         carImg[i].classList.add("w-50");
//       } else {
//         carImg[i].classList.add("w-25");
//       }
//     } else if (screenWidth <= thresholdDesktop) {
//       carImg[i].classList.remove("w-50");
//       if (newScreenWidth <= thresholdMobile) {
//         carImg[i].classList.add("w-75");
//       } else {
//         carImg[i].classList.add("w-25");
//       }
//     } else {
//       carImg[i].classList.remove("w-25");
//       if (newScreenWidth <= thresholdMobile) {
//         carImg[i].classList.add("w-75");
//       } else {
//         carImg[i].classList.add("w-50");
//       }
//     }
//   }
// }
