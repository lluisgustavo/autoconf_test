import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useForm, Link, router } from "@inertiajs/react";
import Input from "@/Components/Input";
import Label from "@/Components/Label";
import Select from "react-select";
import { ArrowLeftCircleIcon } from "@heroicons/react/24/outline";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import { useState, useEffect } from "react";

const VehiclesEdit = (props) => {
    const vehicle = props.vehicle;
    const { data, setData, errors } = useForm({
        make_id: vehicle.make_id.toString(),
        vehicle_model_id: vehicle.vehicle_model_id.toString(),
        price: vehicle.price,
        image_path: vehicle.image_path,
    });

    const [formattedValue, setFormattedValue] = useState("R$ 0,00");
    const [modelsAvailable, setModelsAvailable] = useState(false);
    const { makesOptions, vehicleModelsOptions } = props;

    const filteredVehicleModels = vehicleModelsOptions.filter(
        (option) => !data.make_id || option.make_id === data.make_id
    );

    useEffect(() => {
        if (typeof data.price === "string") {
            const formattedNumber = `R$ ${data.price
                .replace(".", ",")
                .replace(/(\d)(?=(\d{3})+\,)/g, "$1.")}`;

            const inputElement = document.querySelector('[name="price"]');

            if (inputElement) {
                inputElement.value = formattedNumber;
                inputElement.dispatchEvent(
                    new Event("input", { bubbles: true })
                );
            }
        }
    });

    useEffect(() => {
        // Check if there are models for the selected brand
        const brandHasModels = vehicleModelsOptions.some(
            (option) => option.make_id === data.make_id
        );

        setModelsAvailable(brandHasModels);

        if (brandHasModels) {
            setData(
                "vehicle_model_id",
                filteredVehicleModels[0]?.value || null
            );
        }

        if (!brandHasModels) {
            setData({ ...data, vehicle_model_id: null });
        }
    }, [data.make_id, vehicleModelsOptions]);

    const handleFileChange = (e) => {
        const file = e.target.files && e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onloadend = () => {
                setData("image_path", file);
            };

            reader.readAsDataURL(file);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        router.post(route("veiculos.update", vehicle), {
            ...data,
            _method: "patch",
            onSuccess: () => {
                router.visit(route("veiculos.index"));
            },
            onError: (error) => {
                Object.entries(error).forEach(([key, value]) => {
                    toast.error(value);
                });
            },
        });
    };

    function formatNumberToBRL(e) {
        // Remove any non-numeric characters from the input
        let userInput = e.target.value.replace(/[^0-9]/g, "");

        if (userInput === "") {
            // If the input is empty, set the formatted value to "R$ 0,00"
            setFormattedValue("R$ 0,00");
            setData({ ...data, price: 0 });
        } else {
            // Convert the input to a number and divide by 100 to get the value in BRL
            let userInputAsNumber = parseInt(userInput, 10) / 100;

            // Format the number as BRL currency
            let formattedNumber = `R$ ${userInputAsNumber
                .toFixed(2)
                .replace(".", ",")
                .replace(/(\d)(?=(\d{3})+\,)/g, "$1.")}`;

            // Update the state with the formatted value and the user input
            setFormattedValue(formattedNumber);
            setData({ ...data, price: userInputAsNumber });
        }
    }

    return (
        <AuthenticatedLayout
            title="Editar Veículo"
            auth={props.auth}
            errors={props.errors}
            header={
                <div className="flex flex-col text-gray-800 gap-4 md:flex-row md:items-center md:justify-between dark:text-white">
                    <h2 className="text-xl font-semibold leading-tight">
                        Editar Veículo
                    </h2>

                    <Link
                        href={route("veiculos.index")}
                        className="flex items-center px-4 py-2 text-white bg-autoconf-blue rounded-md hover:bg-autoconf-darkblue"
                    >
                        <ArrowLeftCircleIcon
                            aria-hidden="true"
                            className="w-6 h-6"
                        />
                        <span className="pl-2">Voltar</span>
                    </Link>
                </div>
            }
        >
            <ToastContainer />
            <div className="p-6 overflow-hidden bg-autoconf-lightblue rounded-md shadow-md dark:bg-dark-eval-1">
                <form onSubmit={handleSubmit} encType="multipart/form-data">
                    <div className="grid grid-cols-1 gap-4">
                        <Label forInput="make_id" value="Marca" />
                        <Select
                            isClearable
                            menuPortalTarget={document.body}
                            menuPosition={"fixed"}
                            options={makesOptions}
                            value={makesOptions.find(
                                (option) => option.value === data.make_id
                            )}
                            onChange={(selectedOption) => {
                                setData(
                                    "make_id",
                                    selectedOption ? selectedOption.value : null
                                );
                            }}
                            placeholder="Selecione"
                            className="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-autoconf-blue focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                        />

                        <Label
                            forInput="vehicle_model_id"
                            value="Modelo do Veículo"
                        />
                        <Select
                            isClearable
                            menuPortalTarget={document.body}
                            menuPosition={"fixed"}
                            name="vehicle_model_id"
                            options={filteredVehicleModels}
                            value={
                                filteredVehicleModels.length > 0
                                    ? filteredVehicleModels.find(
                                          (option) =>
                                              option.value ===
                                              data.vehicle_model_id
                                      )
                                    : null
                            }
                            onChange={(selectedOption) => {
                                setData(
                                    "vehicle_model_id",
                                    selectedOption ? selectedOption.value : null
                                );
                            }}
                            isDisabled={!modelsAvailable}
                            placeholder="Selecione"
                            className="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-autoconf-blue focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                        />

                        <Label forInput="price" value="Preço" />
                        <Input
                            name="price"
                            placeholder="Preço"
                            value={formattedValue}
                            required
                            maxLength="16"
                            handleChange={(e) => formatNumberToBRL(e)}
                            error={errors.price}
                        />

                        <div className="flex flex-col items-center md:flex-row">
                            <div className="md:w-1/3">
                                {data.image_path &&
                                typeof data.image_path === "string" ? (
                                    <img
                                        src={data.image_path} // When it's a file path
                                        alt="Preview"
                                        className="mt-2 max-h-60"
                                    />
                                ) : (
                                    data.image_path && (
                                        <img
                                            src={URL.createObjectURL(
                                                data.image_path
                                            )} // When it's a file
                                            alt="Preview"
                                            className="mt-2 max-h-60"
                                        />
                                    )
                                )}
                            </div>
                            <div className="md:w-2/3">
                                <Label
                                    forInput="image_path"
                                    value="Selecione uma foto"
                                    className="my-2"
                                />
                                <Input
                                    type="file"
                                    accept="image/jpeg, image/png, image/jpg, image/gif, image/webp"
                                    handleChange={handleFileChange}
                                    className="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-autoconf-blue focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                                />
                            </div>
                        </div>
                    </div>

                    <div className="mt-4">
                        <button
                            type="submit"
                            className="px-4 py-2 text-white bg-autoconf-blue rounded-md hover:bg-autoconf-darkblue"
                        >
                            Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
};

export default VehiclesEdit;
