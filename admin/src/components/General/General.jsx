const { useState } = wp.element;

import About from "./About";
import Manage from "./Manage";
import Navbar from "./Navbar";
import Updates from "./Updates";

const General = () => {
    const [active, setActive] = useState("manage");

    return (
        <div>
            <div className="mb-4">
                <p className="text-xl">General</p>
            </div>
            <Navbar active={active} setActive={setActive} />
            <div className="rounded-b bg-white p-5">
                {active === "manage" ? (
                    <Manage />
                ) : active === "updates" ? (
                    <Updates />
                ) : (
                    <About />
                )}
            </div>
        </div>
    );
};
export default General;
