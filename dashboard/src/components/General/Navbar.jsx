const Item = ({ onClick, active, value, label }) => {
    const activeStyle = "bg-white";
    return (
        <div
            onClick={() => onClick(value)}
            className={`cursor-pointer rounded-t p-3 ${
                active === value ? activeStyle : ""
            }`}
        >
            {label}
        </div>
    );
};

const Navbar = ({ active, setActive }) => {
    return (
        <nav className="flex space-x-3">
            <Item
                active={active}
                onClick={setActive}
                value="manage"
                label="Manage Settings"
            />
            <Item
                active={active}
                onClick={setActive}
                value="updates"
                label="Updates"
            />
            <Item
                active={active}
                onClick={setActive}
                value="about"
                label="About"
            />
        </nav>
    );
};
export default Navbar;
