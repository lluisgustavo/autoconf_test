import PerfectScrollbar from "@/Components/PerfectScrollbar";
import { SidebarLink } from "@/Components/Sidebar/Sidebar";
import { DashboardIcon } from "@/Components/Icons/outline";
import {
    BriefcaseIcon,
    CubeIcon,
    TruckIcon,
} from "@heroicons/react/24/outline";

export default () => {
    return (
        <PerfectScrollbar
            tag="nav"
            className="flex flex-col flex-1 max-h-full gap-4 px-3"
        >
            <SidebarLink
                title={"Home"}
                href={route("dashboard")}
                active={route().current("dashboard")}
                icon={
                    <DashboardIcon
                        aria-hidden="true"
                        className="flex-shrink-0 w-6 h-6"
                    />
                }
            />

            <SidebarLink
                title={"Marcas"}
                href={route("marcas.index")}
                active={route().current("marcas.*")}
                icon={
                    <BriefcaseIcon
                        aria-hidden="true"
                        className="flex-shrink-0 w-6 h-6"
                    />
                }
            />

            <SidebarLink
                title={"Modelos"}
                href={route("modelos.index")}
                active={route().current("modelos.*")}
                icon={
                    <CubeIcon
                        aria-hidden="true"
                        className="flex-shrink-0 w-6 h-6"
                    />
                }
            />

            <SidebarLink
                title={"Veículos"}
                href={route("veiculos.index")}
                active={route().current("veiculos.*")}
                icon={
                    <TruckIcon
                        aria-hidden="true"
                        className="flex-shrink-0 w-6 h-6"
                    />
                }
            />
        </PerfectScrollbar>
    );
};
