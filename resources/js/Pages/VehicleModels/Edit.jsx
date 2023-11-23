import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useForm, Link, router } from "@inertiajs/react";
import Input from "@/Components/Input";
import Label from "@/Components/Label";
import { fuelTypeOptions } from "@/utils/fuelTypes";
import { vehicleTypeOptions } from "@/utils/vehicleTypes";
import Select from "react-select";
import { ArrowLeftCircleIcon } from "@heroicons/react/24/outline";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const VehicleModelsEdit = (props) => {
    const vehicleModel = props.vehicleModel;

    const { data, setData, put, errors } = useForm({
        make_id: vehicleModel.make_id,
        name: vehicleModel.name,
        manufacturing_year: vehicleModel.manufacturing_year,
        fuel_type: vehicleModel.fuel_type,
        type: vehicleModel.type,
    });

    const makesOptions = props.makesOptions;

    const handleSubmit = (e) => {
        e.preventDefault();

        put(route("modelos.update", vehicleModel), {
            data,
            onSuccess: () => {
                router.visit(route("modelos.index"));
            },
            onError: (error) => {
                Object.entries(error).forEach(([key, value]) => {
                    toast.error(value);
                });
            },
        });
    };

    return (
        <AuthenticatedLayout
            title="Editar Modelo"
            auth={props.auth}
            errors={props.errors}
            header={
                <div className="flex flex-col text-gray-800 gap-4 md:flex-row md:items-center md:justify-between dark:text-white">
                    <h2 className="text-xl font-semibold leading-tight">
                        Editar Modelo
                    </h2>

                    <Link
                        href={route("modelos.index")}
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
                <form onSubmit={handleSubmit}>
                    <div className="grid grid-cols-1 gap-4">
                        <Label forInput="make_id" value="Marca" />
                        <Select
                            isClearable
                            menuPortalTarget={document.body}
                            menuPosition={"fixed"}
                            options={makesOptions}
                            value={makesOptions.find(
                                (option) =>
                                    option.value === data.make_id.toString()
                            )}
                            onChange={(selectedOption) =>
                                setData(
                                    "make_id",
                                    selectedOption ? selectedOption.value : ""
                                )
                            }
                            placeholder="Selecione"
                            className="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-autoconf-blue focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                        />

                        <Label forInput="name" value="Nome" />
                        <Input
                            name="name"
                            placeholder="Nome"
                            value={data.name}
                            required
                            isFocused
                            handleChange={(e) =>
                                setData("name", e.target.value)
                            }
                            error={errors.name}
                        />

                        <Label
                            forInput="manufacturing_year"
                            value="Ano de Fabricaão"
                        />
                        <Input
                            name="manufacturing_year"
                            placeholder="Ano de Fabricação"
                            value={data.manufacturing_year}
                            maxLength="4"
                            handleChange={(e) => {
                                const result = e.target.value.replace(
                                    /\D/g,
                                    ""
                                );
                                setData("manufacturing_year", result);
                            }}
                            error={errors.manufacturing_year}
                        />

                        <Label
                            forInput="fuel_type"
                            value="Tipo de Combustível"
                        />
                        <Select
                            isClearable
                            menuPortalTarget={document.body}
                            menuPosition={"fixed"}
                            options={fuelTypeOptions}
                            value={fuelTypeOptions.find(
                                (option) => option.value === data.fuel_type
                            )}
                            onChange={(selectedOption) =>
                                setData(
                                    "fuel_type",
                                    selectedOption ? selectedOption.value : ""
                                )
                            }
                            placeholder="Selecione"
                            className="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-autoconf-blue focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                        />

                        <Label forInput="type" value="Tipo de Veículo" />
                        <Select
                            isClearable
                            menuPortalTarget={document.body}
                            menuPosition={"fixed"}
                            options={vehicleTypeOptions}
                            value={vehicleTypeOptions.find(
                                (option) => option.value === data.type
                            )}
                            onChange={(selectedOption) =>
                                setData(
                                    "type",
                                    selectedOption ? selectedOption.value : ""
                                )
                            }
                            placeholder="Selecione"
                            className="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-autoconf-blue focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                        />
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

export default VehicleModelsEdit;
