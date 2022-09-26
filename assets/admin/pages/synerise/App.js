import React from "react";
import {Link, useLocation} from "react-router-dom";
import apiFetch from "@wordpress/api-fetch";
import Navbar from "@synerise/ds-navbar";
import Button from "@synerise/ds-button";
import AppSettings from "./AppSettings";
import AppDashboard from "./AppDashboard";
import AppWizard from "./AppWizard";

const App = () => {
    const path = window.rest.url;
    const location = useLocation();

    const getSettings = async (endpoint = '') => {
        return await apiFetch({
            path: path+endpoint,
            method: "GET",
            headers: {'X-WP-Nonce': window.rest.nonce}
        });
    };

    const updateSettings = async (endpoint = '', data) => {
        return apiFetch({
            path: path+endpoint,
            data,
            method: "POST",
            headers: {'X-WP-Nonce': window.rest.nonce}
        });
    };

    const useQuery = () => {
        const { search } = useLocation();
        return React.useMemo(() => new URLSearchParams(search), [search]);
    }

    const switchRender = () => {
        let query = useQuery();
        switch (query.get('page')) {
            case 'synerise':
                return <AppDashboard getSettings={getSettings} updateSettings={updateSettings}/>;
            case 'synerise/wizard':
                return <AppWizard getSettings={getSettings} updateSettings={updateSettings} />;
            case 'synerise/settings':
                return <AppSettings getSettings={getSettings} updateSettings={updateSettings}/>;
            default:
                return <AppDashboard />;
        }
    }

    return(
        <>
            { useQuery().get('page') !== 'synerise/wizard' &&
                <Navbar
                    actions={null}
                    additionalNodes={[
                        <>
                            <Link to={location.pathname+'?page=synerise'}>
                                <Button
                                    mode={"simple"}
                                    type={"primary"}
                                    color={"primary"}
                                >
                                    Dashboard
                                </Button>
                            </Link>
                            <Link to={location.pathname+'?page=synerise/settings'}>
                                <Button
                                    mode="simple"
                                    type={"primary"}
                                    color={"primary"}
                                >
                                    Settings
                                </Button>
                            </Link>
                        </>
                    ]}
                    alertNotification={null}
                    color="#0b68ff"
                    logo="https://app.synerise.com/static/images/logo.svg"
                    description={"for WooCommerce"}
                />
            }
            {switchRender()}
        </>
    );
}

export default App;