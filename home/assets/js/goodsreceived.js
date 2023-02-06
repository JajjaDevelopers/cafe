
const coffeeGrade = {
  arabica_grades: ["Arabica A", "Arabica AA", "Arabica AAA", "Arabica B", "Arabica AB", "Arabica CPB", "Triage", "Black Beans"],
  robusta_grades: ["Screen 1800", "Screen 1700", "Screen 1500", "Screen 1200", "Black Beans", "BHP", "1899"]
}

const option = document.getElementById("select");
const checkedOption = document.querySelectorAll(".coffee");
console.log(checkedOption);
let choice;
checkedOption.forEach(checked => {
  checked.addEventListener("click", (event) => {
      choice = event.target.id;
      let selection = "<option>" + "" + "</option>";

      if (choice === "ar") {
          for (let i = 0; i < coffeeGrade.arabica_grades.length; i++) {
              selection += "<option>" + coffeeGrade.arabica_grades[i] + "</option>"
          }
          option.innerHTML = selection;
      } else {
          for (let i = 0; i < coffeeGrade.robusta_grades.length; i++) {
              selection += "<option>" + coffeeGrade.robusta_grades[i] + "</option>"
          }
          option.innerHTML = selection;
      }
  })
})