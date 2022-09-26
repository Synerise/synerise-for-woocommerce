import React, { useEffect, useState } from "react";
import Select from "@synerise/ds-select";
import Form from "@synerise/ds-form";
import Divider from "@synerise/ds-divider";
import { Field } from 'react-final-form';
import {Input, TextArea} from "@synerise/ds-input";
import {Title} from "@synerise/ds-typography";

const StepTrackingCode = ({values, form, defaultData}) => {

    return(
        <>
            <Form.FieldSet>
                <Title level={3} style={{marginBottom: "12px"}}>Tracking Code</Title>
                <Field name={'page_tracking_enabled'} initialValue={defaultData.page_tracking_enabled}>
                    {({ input, meta }) => (
                        <>
                            <Select
                                {...input}
                                className={'w-100'}
                                defaultValue={false}
                                value={values.page_tracking_enabled}
                                label={"Enabled"}
                                placeholder="Select option"
                                style={{ marginBottom: 12 }}
                                onChange={(value, option) => { form.change(input.name, value) }}
                            >
                                <Select.Option value={true}>Yes</Select.Option>
                                <Select.Option value={false}>No</Select.Option>
                            </Select>
                            {meta.error && meta.touched && <span>{meta.error}</span>}
                        </>
                    )}
                </Field>

                <Field name={'page_tracking_open_graph_enabled'} initialValue={defaultData.page_tracking_open_graph_enabled}>
                    {({ input, meta }) => (
                        <Select
                            label={"Open Graph"}
                            placeholder="Select option"
                            className={'w-100'}
                            style={{ marginBottom: 12 }}
                            defaultValue={false}
                            value={values.page_tracking_open_graph_enabled}
                            onChange={(value, option) => { form.change(input.name, value) }}
                        >
                            <Select.Option key="true" value={true}>Yes</Select.Option>
                            <Select.Option key="false" value={false}>No</Select.Option>
                        </Select>
                    )}
                </Field>
                <Field
                    name={'page_tracking_cookie_domain'}
                >
                    {({ input, meta }) => (
                        <Input
                            {...input}
                            className={'w-100'}
                            disabled={!values.page_tracking_enabled}
                            label={"Cookie domain"}
                            type={"text"}
                            description={"Common cookie domain can be set if a single Workspace is shared across many subdomains. Otherwise it should be left blank."}
                        />
                    )}
                </Field>

                <Divider
                    marginBottom={24}
                    marginTop={24}
                    orientation="center"
                />

                <Title level={3} style={{marginBottom: "12px"}}>Custom script</Title>
                <div style={{ marginBottom: 12 }}>Custom script should be used only if basic config is insufficient. By default, the tracking script will be obtained automatically.</div>
                <Field name={'page_tracking_custom_script_enabled'}>
                    {({ input, meta }) => (
                        <Select
                            className={'w-100'}
                            label={"Enabled"}
                            placeholder="Select option"
                            style={{ marginBottom: 12 }}
                            disabled={!values.page_tracking_enabled}
                            defaultValue={false}
                            value={values.page_tracking_custom_script_enabled}
                            onChange={(value, option) => {form.change(input.name, value)}}
                        >
                            <Select.Option value={true}>Yes</Select.Option>
                            <Select.Option value={false}>No</Select.Option>
                        </Select>
                    )}
                </Field>

                <Field name={'page_tracking_custom_script'}>
                    {({ input, meta }) => (
                        <TextArea
                            {...input}
                            className={'w-100'}
                            disabled={!values.page_tracking_enabled}
                            name={'page_tracking_custom_script'}
                            label={"Script"}
                            rows={4}
                        />
                    )}
                </Field>
            </Form.FieldSet>
        </>
    )
}

export default StepTrackingCode;