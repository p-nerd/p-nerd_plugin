const { render } = wp.element;
import "./index.css";
import App from "./App";

const theDiv = document.getElementById("p-nerd-plugin-admin-app");

if (theDiv) render(<App />, theDiv);
