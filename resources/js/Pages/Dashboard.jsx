import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default (props) => {
    return (
        <AuthenticatedLayout
            title="Dashboard"
            auth={props.auth}
            errors={props.errors}
            header={
                <div className="flex flex-col text-gray-800 gap-4 md:flex-row md:items-center md:justify-between dark:text-white">
                    <h2 className="text-xl font-semibold leading-tight">
                        Dashboard
                    </h2>
                </div>
            }
        >
            <div className="p-6 overflow-hidden bg-autoconf-lightblue rounded-md shadow-md dark:bg-dark-eval-1">
                Bem vindo.
            </div>
        </AuthenticatedLayout>
    );
};
