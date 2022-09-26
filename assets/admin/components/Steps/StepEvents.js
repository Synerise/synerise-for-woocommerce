import React, { useEffect, useState } from "react";
import Select from "@synerise/ds-select";
import { Field } from 'react-final-form';
import {Title} from "@synerise/ds-typography";

const StepEvents = ({values, form, defaultData}) => {

    return(
        <>
            <Title level={3} style={{marginBottom: "12px"}}>Events Tracking</Title>
            <Field name={'event_tracking_enabled'} defaultValue={defaultData.event_tracking_enabled}>
                {({ input, meta }) => (
                    <Select
                        label={"Enabled"}
                        className={'w-100'}
                        style={{ marginBottom: 12 }}
                        defaultValue={defaultData.event_tracking_enabled}
                        onChange={(value, option) => {
                            form.change(input.name, value);
                        }}
                    >
                        <Select.Option value={true}>Yes</Select.Option>
                        <Select.Option value={false}>No</Select.Option>
                    </Select>
                )}
            </Field>
            <Field name={'event_tracking_events'}>
                {({ input, meta }) => (
                    <Select
                        label={"Events"}
                        className={'w-100'}
                        defaultValue={() => {
                            return defaultData.event_tracking_events ? defaultData.event_tracking_events.map((event) => {
                                return event.label
                            }) : null;
                        }}
                        placeholder={"Select options"}
                        mode={"multiple"}
                        onChange={(values, options) => {
                            form.change(input.name, options.map((option) => {
                                return {
                                    value: option.data,
                                    label: option.value
                                }
                            }));
                        }}
                    >
                        {
                            defaultData.event_tracking_events_list.map((event) => {
                                return (<Select.Option value={event.label} data={event.action} />)
                            })
                        }
                    </Select>
                )}
            </Field>
        </>
    )
}

export default StepEvents;