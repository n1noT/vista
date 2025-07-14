import { Controller } from "@hotwired/stimulus";

/*
 * This is a Stimulus controller for managing themes.
 * Any element with a data-controller="theme" attribute will cause
 * this controller to be executed.
 */

export default class extends Controller {
  connect() {
    console.log("Theme Controller Connected!");
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        this.setTheme(savedTheme);
    }
    // Set up event listeners for theme toggle
    const themeToggle = document.getElementById("theme-toggle");
    if (themeToggle) {
      themeToggle.addEventListener("change", this.onToggleTheme.bind(this));
      themeToggle.checked = savedTheme === "light"; // Set initial state based on saved theme
    }
  }

  onToggleTheme(event) {
    const isChecked = event.target.checked;
    const theme = isChecked ? "light" : "dark";
    this.setTheme(theme);
  }

  setTheme(theme) {
    // Set the theme on the document element
    document.documentElement.setAttribute("data-theme", theme);
    // Save the theme to localStorage
    localStorage.setItem("theme", theme);
  }
}
