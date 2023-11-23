import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { PlusIcon } from "@heroicons/react/24/outline";
import { Link, router } from "@inertiajs/react";
import { useState } from "react";

const VehiclesIndex = (props) => {
    function formatNumberToBRL(value) {
        // Format the number as BRL currency
        let formattedNumber = `R$ ${value
            .replace(".", ",")
            .replace(/(\d)(?=(\d{3})+\,)/g, "$1.")}`;

        // Update the state with the formatted value and the user input
        return formattedNumber;
    }

    const handleDelete = (id) => {
        router.delete(route("veiculos.destroy", id));
    };

    const handleSort = (column) => {
        const urlParams = new URLSearchParams(window.location.search);
        const direction =
            (urlParams.get("column") == column &&
                urlParams.get("direction") === "desc") ||
            urlParams.get("direction") === null
                ? "asc"
                : "desc";

        const url = route("veiculos.index", {
            column,
            direction,
        });
        router.visit(url);
    };

    return (
        <AuthenticatedLayout
            title="Veículos"
            auth={props.auth}
            errors={props.errors}
            header={
                <div className="flex flex-col text-gray-800 gap-4 md:flex-row md:items-center md:justify-between dark:text-white">
                    <h2 className="text-xl font-semibold leading-tight">
                        Veículos
                    </h2>

                    <Link
                        href={route("veiculos.create")}
                        className="flex items-center px-4 py-2 text-white bg-autoconf-blue rounded-md hover:bg-autoconf-darkblue"
                    >
                        <PlusIcon aria-hidden="true" className="w-6 h-6" />
                        <span className="pl-2">Adicionar</span>
                    </Link>
                </div>
            }
        >
            <div className="p-6 overflow-hidden bg-autoconf-lightblue rounded-md shadow-md dark:bg-dark-eval-1">
                <div className="overflow-x-auto">
                    <table className="min-w-full border rounded-md overflow-hidden">
                        <thead className="bg-gray-50 dark:bg-dark-eval-2">
                            <tr className="border-b ">
                                <th className="py-2 px-4 border-r">Foto</th>
                                <th className="py-2 px-4 border-r">
                                    <button onClick={() => handleSort("make")}>
                                        Marca
                                    </button>
                                </th>
                                <th className="py-2 px-4 border-r">
                                    <button onClick={() => handleSort("model")}>
                                        Modelo
                                    </button>
                                </th>
                                <th className="py-2 px-4 border-r">
                                    <button onClick={() => handleSort("price")}>
                                        Preço
                                    </button>
                                </th>
                                <th className="py-2 px-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody className="bg-gray-50 dark:bg-dark-eval-2 text-center">
                            {props.vehicles.data.map((vehicle) => (
                                <tr key={vehicle.id} className="border-b">
                                    <td className="py-2 px-4 border-r flex justify-center items-center">
                                        {vehicle.image_path && (
                                            <img
                                                src={vehicle.image_path}
                                                alt="Preview"
                                                className="mt-2 max-h-60"
                                            />
                                        )}
                                    </td>
                                    <td className="py-2 px-4 border-r">
                                        {vehicle.make.name}
                                    </td>
                                    <td className="py-2 px-4 border-r">
                                        {vehicle.model.name}
                                    </td>
                                    <td className="py-2 px-4 border-r">
                                        {formatNumberToBRL(vehicle.price)}
                                    </td>
                                    <td className="py-2 px-4">
                                        <Link
                                            href={route(
                                                "veiculos.edit",
                                                vehicle.id
                                            )}
                                            className="text-blue-600 hover:underline mr-2"
                                        >
                                            Editar
                                        </Link>
                                        <button
                                            onClick={() =>
                                                handleDelete(vehicle.id)
                                            }
                                            className="text-red-600 hover:underline"
                                        >
                                            Deletar
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
                <div className="mt-4 text-center">
                    {props.vehicles.links.map((link, index) => (
                        <Link
                            key={index}
                            href={link.url}
                            className={`inline-block px-3 py-1 mr-2 ${
                                link.active
                                    ? "bg-autoconf-blue text-white"
                                    : "bg-gray-50 dark:bg-dark-eval-1"
                            }`}
                        >
                            {link.label === "&laquo; Anterior"
                                ? "<<"
                                : link.label === "Próximo &raquo;"
                                ? ">>"
                                : link.label}
                        </Link>
                    ))}
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default VehiclesIndex;
