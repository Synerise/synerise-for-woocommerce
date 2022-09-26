import StepAPI from "../components/Steps/StepAPI";
import StepTrackingCode from "../components/Steps/StepTrackingCode";
import StepEvents from "../components/Steps/StepEvents";
import StepSynchronization from "../components/Steps/StepSynchronization";
import StepData from "../components/Steps/StepData";
import TabSyneriseApi from "../components/TabSyneriseApi";
import TabPageTracking from "../components/TabPageTracking";
import TabEventTracking from "../components/TabEventTracking";
import TabData from "../components/TabData";
import TabSynchronization from "../components/TabSynchronization";
import TabOptIn from "../components/TabOptIn";
import React from "react";

export const inCardGridProps = {
    xs: 8,
    sm: 8,
    md: 12,
    lg: 16,
    xl: 18,
    xxl: 24
};

export const WizardSteps = [
    {
        id: "step-1",
        label: "API Key",
        render: StepAPI,
    },
    {
        id: "step-2",
        label: "Tracking Code",
        render: StepTrackingCode,
    },
    {
        id: "step-3",
        label: "Events",
        render: StepEvents,
    },
    {
        id: "step-4",
        label: "Data",
        render: StepData,
    },
    {
        id: "step-5",
        label: "Synchronization",
        render: StepSynchronization
    },
];

export const SettingsTabs = [
    {
        label: "Api",
        render: TabSyneriseApi,
    },
    {
        label: "Tracking",
        render: TabPageTracking,
    },
    {
        label: "Events",
        render: TabEventTracking,
    },
    {
        label: "Data",
        render: TabData,
    },
    {
        label: "Synchronization",
        render: TabSynchronization,
    },
    {
        label: "Marketing agreements",
        render: TabOptIn
    }
];