import React, { useEffect, useState } from "react";
import { Field } from 'react-final-form';
import { CardGroup } from "@synerise/ds-card";
import Form from "@synerise/ds-form";
import {Input, TextArea} from "@synerise/ds-input";
import Select from '@synerise/ds-select';
import Grid from "@synerise/ds-grid";
import Card from "../components/Card";
import {inCardGridProps} from "../config/constants";

const TabPageTracking = ({settings, values, form}) => {

    return(
        <CardGroup>
            <Card
                localKey={"page-tracking-card"}
                withHeader={true}
                lively={true}
                title={"Tracking"}
            >
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'page_tracking_enabled'} initialValue={settings.page_tracking_enabled}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Enabled"}
                                        placeholder="Select option"
                                        style={{ marginBottom: 12 }}
                                        defaultValue={settings.page_tracking_enabled}
                                        onChange={(value, option) => {
                                            form.change(input.name, value);
                                        }}
                                    >
                                        <Select.Option value={true}>Yes</Select.Option>
                                        <Select.Option value={false}>No</Select.Option>
                                    </Select>
                                )}
                            </Field>
                            <Field name={'page_tracking_open_graph_enabled'} initialValue={settings.page_tracking_open_graph_enabled}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Open Graph"}
                                        placeholder="Select option"
                                        style={{ marginBottom: 12 }}
                                        defaultValue={settings.page_tracking_open_graph_enabled}
                                        onChange={(value, option) => {
                                            form.change(input.name, value);
                                        }}
                                    >
                                        <Select.Option key="true" value={true}>Yes</Select.Option>
                                        <Select.Option key="false" value={false}>No</Select.Option>
                                    </Select>
                                )}
                            </Field>
                            <Field name={'page_tracking_cookie_domain'} initialValue={settings.page_tracking_cookie_domain}>
                                {({ input, meta }) => (
                                    <Input
                                        {...input}
                                        label={"Cookie domain"}
                                        type={"text"}
                                        description={"Common cookie domain can be set if a single Workspace is shared across many subdomains. Otherwise it should be left blank."}
                                    />
                                )}
                            </Field>
                        </Form.FieldSet>
                    </Grid.Item>
                </Grid>
            </Card>
            <Card
                localKey={"page-tracking-custom-card"}
                withHeader={true}
                lively={true}
                title={"Custom script"}
            >
                <div>Custom script should be used only if basic config is insufficient. By default, the tracking script will be obtained automatically.</div>
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'page_tracking_custom_enabled'} initialValue={settings.page_tracking_custom_enabled}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Enabled"}
                                        placeholder="Select option"
                                        style={{ marginBottom: 12 }}
                                        defaultValue={settings.page_tracking_custom_enabled}
                                        onChange={(value, option) => {
                                            form.change(input.name, value);
                                        }}                                >
                                        <Select.Option value={true}>Yes</Select.Option>
                                        <Select.Option value={false}>No</Select.Option>
                                    </Select>
                                )}
                            </Field>
                            <Field name={'page_tracking_script'} initialValue={settings.page_tracking_script}>
                                {({ input, meta }) => (
                                    <TextArea
                                        {...input}
                                        label={"Script"}
                                        rows={4}
                                    />
                                )}
                            </Field>
                        </Form.FieldSet>
                    </Grid.Item>
                </Grid>
            </Card>
        </CardGroup>
    );
}


export default TabPageTracking;