var labelsVisible = false;

function toggleLabels() {
  labelsVisible = !labelsVisible; // Inverse l'état actuel

  var labels = document.querySelectorAll("label");
  labels.forEach(function(label) {
    label.style.display = labelsVisible ? "block" : "none";
  });

  var button = document.querySelector(".btn1");
  button.value = labelsVisible ? "-Moins critère" : "+Plus critère";
}