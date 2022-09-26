import React, { useEffect, useState } from "react";
import { Field } from 'react-final-form';
import Select from "@synerise/ds-select";
import {Input} from "@synerise/ds-input";
import {Title} from "@synerise/ds-typography";
import Divider from "@synerise/ds-divider";

const StepSynchronization = ({values, form = null, defaultData}) => {

    return(
        <>
            <Title level={3} style={{marginBottom: "12px"}}>Full Synchronization</Title>
            <Field name={'synchronization_data_synchronization_enabled'} initialValue={defaultData.synchronization_data_synchronization_enabled}>
                {({ input, meta }) => (
                <Select
                    className={'w-100'}
                    label={"Enabled"}
                    placeholder="Select option"
                    description={"Before enabling, verify the data configuration to make sure it contains all models & attributes you want to include."}
                    defaultValue={defaultData.synchronization_data_synchronization_enabled}
                    onChange={(value, option) => {form.change(input.name, value)}}
                >
                    <Select.Option key="true" value={true}>Yes</Select.Option>
                    <Select.Option key="false" value={false}>No</Select.Option>
                </Select>
                )}
            </Field>
            <Field name={'synchronization_data_synchronization_cron_expression'} initialValue={defaultData.synchronization_data_synchronization_cron_expression}>
                {({ input, meta }) => (
                <Input
                    {...input}
                    className={'w-100'}
                    label={"Cron expression"}
                    type={"text"}
                    placeholder="* * * * *"
                    description={<a href="https://crontab.guru/" target="_blank">Generator</a>}
                />
                )}
            </Field>
            <Field name={'synchronization_data_synchronization_page_size'} initialValue={defaultData.synchronization_data_synchronization_page_size}>
                {({ input, meta }) => (
                <Input
                    {...input}
                    className={'w-100'}
                    label={"Page size"}
                    type={"number"}
                    placeholder={"100"}
                />
                )}
            </Field>

            <Divider
                marginBottom={24}
                marginTop={24}
                orientation="center"
            />

            <Title level={3} style={{marginBottom: "12px"}}>Updates Synchronization</Title>
            <Field name={'synchronization_updates_synchronization_enabled'} initialValue={defaultData.synchronization_updates_synchronization_enabled}>
                {({ input, meta }) => (
                    <Select
                        className={'w-100'}
                        label={"Enabled"}
                        placeholder="Select option"
                        description={"Before enabling, verify the data configuration to make sure it contains all models & attributes you want to include."}
                        defaultValue={defaultData.synchronization_updates_synchronization_enabled}
                        onChange={(value, option) => {form.change(input.name, value)}}
                    >
                        <Select.Option key="true" value={true}>Yes</Select.Option>
                        <Select.Option key="false" value={false}>No</Select.Option>
                    </Select>
                )}
            </Field>
            <Field name={'synchronization_updates_synchronization_cron_expression'} initialValue={defaultData.synchronization_updates_synchronization_cron_expression}>
                {({ input, meta }) => (
                    <Input
                        {...input}
                        className={'w-100'}
                        label={"Cron expression"}
                        type={"text"}
                        placeholder="* * * * *"
                        description={<a href="https://crontab.guru/" target="_blank">Generator</a>}
                    />
                )}
            </Field>
            <Field name={'synchronization_updates_synchronization_page_size'} initialValue={defaultData.synchronization_updates_synchronization_page_size}>
                {({ input, meta }) => (
                    <Input
                        {...input}
                        className={'w-100'}
                        label={"Page size"}
                        type={"number"}
                        placeholder={"100"}
                    />
                )}
            </Field>
        </>
    )
}

export default StepSynchronization;