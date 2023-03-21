import CPT from "./CPT/CPT";
import General from "./General/General";
import Taxonomies from "./Taxonomies/Taxonomies";
import Widgets from "./Widgets/Widgets";

const App = () => {
    const params = new URL(document.location).searchParams;
    const page = params.get("page");

    return (
        <div>
            <div className="mb-4">
                <p className="text-4xl">PNerd Plugin</p>
            </div>
            {page === "p-nerd-plugin-settings-cpt" ? (
                <CPT />
            ) : page === "p-nerd-plugin-settings-taxonomies" ? (
                <Taxonomies />
            ) : page === "p-nerd-plugin-settings-widgets" ? (
                <Widgets />
            ) : (
                <General />
            )}
        </div>
    );
};
export default App;
