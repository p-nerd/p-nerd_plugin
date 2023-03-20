const { render, StrictMode } = wp.element;
import "./index.css";
import App from "./components/App";

const theDiv = document.getElementById("p-nerd-plugin-admin-app");

if (theDiv)
    render(
        <StrictMode>
            <App />
        </StrictMode>,
        theDiv
    );
