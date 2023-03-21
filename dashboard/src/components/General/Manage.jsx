const { useState, useEffect } = wp.element;

const Field = ({ label, id, checked, onClick }) => {
    return (
        <div>
            <label className="relative mb-5 inline-flex cursor-pointer items-center">
                <input
                    className="peer sr-only"
                    type="checkbox"
                    id={id}
                    name="activate-cpt"
                    checked={checked}
                    onClick={onClick}
                />
                <div className="peer h-5 w-9 rounded-full bg-gray-200 after:absolute after:top-[2px] after:left-[2px] after:h-4 after:w-4 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300" />
                <span className="ml-3 text-sm font-medium">{label}</span>
            </label>
        </div>
    );
};

const Manage = () => {
    const activationOptionFieldDefaultData =
        appLocalizer?.activation_option_field_default_data;
    for (const key in activationOptionFieldDefaultData) {
        if (Object.hasOwnProperty.call(activationOptionFieldDefaultData, key)) {
            activationOptionFieldDefaultData[key] = false;
        }
    }
    const [settingsActivationData, setSettingsActivationData] = useState(
        activationOptionFieldDefaultData
    );
    const [isLoading, setIsLoading] = useState(false);

    const url = `${appLocalizer.apiUrl}/settings-activations`;
    const nonceHeader = { "X-WP-NONCE": appLocalizer.nonce };

    console.log(settingsActivationData);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await fetch(url, {
                    headers: { ...nonceHeader },
                });
                const data = await response.json();
                // console.log(data);
                setSettingsActivationData(data);
            } catch (error) {
                console.log(error);
            }
        };
        fetchData();
    }, []);

    const handleClick = checkbox => {
        setSettingsActivationData({
            ...settingsActivationData,
            [checkbox]: !settingsActivationData[checkbox],
        });
    };

    const handleSubmit = async () => {
        setIsLoading(true);
        try {
            const response = await fetch(url, {
                headers: { ...nonceHeader, "Content-Type": "application/json" },
                method: "POST",
                body: JSON.stringify({ data: settingsActivationData }),
            });
            await response.json();
            window.location.reload();
        } catch (error) {
            console.log(error);
        }
        setIsLoading(false);
    };

    return (
        <div>
            <div className="mt-3 mb-5 flex flex-col space-y-5 ">
                <p className=" text-2xl">Settings Manager</p>
                <p className="text-sm">
                    Manage the Sections and Features of the this Plugin by
                    activating the checkboxes from the following list.
                </p>
            </div>

            <form
                onSubmit={e => {
                    e.preventDefault();
                    handleSubmit();
                }}
            >
                <div className="flex flex-col space-y-5">
                    <Field
                        label="Activate CPT Settings"
                        id="activate-cpt"
                        checked={settingsActivationData["cpt"]}
                        onClick={() => handleClick("cpt")}
                    />
                    <Field
                        label="Activate Taxonomy Settings"
                        id="activate-taxonomy"
                        checked={settingsActivationData["taxonomy"]}
                        onClick={() => handleClick("taxonomy")}
                    />
                    <Field
                        label="Activate Media Widget Settings"
                        id="activate-media-widget"
                        checked={settingsActivationData["mediaWidget"]}
                        onClick={() => handleClick("mediaWidget")}
                    />
                    <button
                        type="submit"
                        className={`w-fit rounded ${
                            isLoading ? "bg-[#2271B1]" : "bg-[#2C3338]"
                        } py-2 px-3 text-white hover:bg-[#2271B1]`}
                    >
                        {isLoading ? "Saving... Changes" : "Save Change"}
                    </button>
                </div>
            </form>
        </div>
    );
};

export default Manage;
