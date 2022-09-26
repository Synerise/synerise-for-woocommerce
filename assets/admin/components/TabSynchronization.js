import React, { useEffect, useState } from "react";
import { CardGroup } from "@synerise/ds-card";
import { Field } from 'react-final-form';
import Form from "@synerise/ds-form";
import { Input } from "@synerise/ds-input";
import Select from '@synerise/ds-select';
import Grid from "@synerise/ds-grid";
import Card from "../components/Card";
import {inCardGridProps} from "../config/constants";

const TabSynchronization = ({settings, values, form}) => {

    return(
        <CardGroup>
            <Card
                localKey={"synerise-synchronization-full-synchronization-card"}
                withHeader={true}
                lively={true}
                title={"Full Synchronization"}
            >
                <div>This process will send all the data collected prior to its start. To resend all the items or the items created since the integration, go to Marketing > Synerise > Dashboard.</div>
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'synchronization_data_synchronization_enabled'} initialValue={settings.synchronization_data_synchronization_enabled}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Enabled"}
                                        style={{ marginBottom: 12 }}
                                        placeholder="Select option"
                                        description={"Before enabling, verify the data configuration to make sure it contains all models & attributes you want to include."}
                                        defaultValue={settings.synchronization_data_synchronization_enabled}
                                        onChange={(value, option) => {
                                            form.change(input.name, value);
                                        }}
                                    >
                                        <Select.Option key="true" value={true}>Yes</Select.Option>
                                        <Select.Option key="false" value={false}>No</Select.Option>
                                    </Select>
                                )}
                            </Field>
                            <Field name={'synchronization_data_synchronization_cron_expression'} initialValue={settings.synchronization_data_synchronization_cron_expression}>
                                {({ input, meta }) => (
                                    <Input
                                        {...input}
                                        label={"Cron expression"}
                                        type={"text"}
                                        placeholder="* * * * *"
                                        description={<a href="https://crontab.guru/" target="_blank">Generator</a>}
                                    />
                                )}
                            </Field>
                            <Field name={'synchronization_data_synchronization_page_size'} initialValue={settings.synchronization_data_synchronization_page_size}>
                                {({ input, meta }) => (
                                    <Input
                                        {...input}
                                        label={"Page size"}
                                        type={"number"}
                                        placeholder={"100"}
                                    />
                                )}
                            </Field>
                        </Form.FieldSet>
                    </Grid.Item>
                </Grid>
            </Card>
            <Card
                localKey={"synerise-synchronization-updates-synchronization-card"}
                withHeader={true}
                lively={true}
                title={"Updates Synchronization"}
            >
                <div>This process will send the data that has recently changed. It is based on items queue & the data will be send in the background.</div>
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'synchronization_updates_synchronization_enabled'} initialValue={settings.synchronization_updates_synchronization_enabled}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Enabled"}
                                        placeholder="Select option"
                                        description={"Before enabling, verify the data configuration to make sure it contains all models & attributes you want to include."}
                                        style={{ marginBottom: 12 }}
                                        defaultValue={settings.synchronization_updates_synchronization_enabled}
                                        onChange={(value, option) => {
                                            form.change(input.name, value);
                                        }}
                                    >
                                        <Select.Option key="true" value={true}>Yes</Select.Option>
                                        <Select.Option key="false" value={false}>No</Select.Option>
                                    </Select>
                                )}
                            </Field>
                            <Field name={'synchronization_updates_synchronization_cron_expression'} initialValue={settings.synchronization_updates_synchronization_cron_expression}>
                                {({ input, meta }) => (
                                    <Input
                                        {...input}
                                        label={"Cron expression"}
                                        placeholder="* * * * *"
                                        description={<a href="https://crontab.guru/" target="_blank">Generator</a>}
                                        name={"synchronization_updates_synchronization_cron_expression"}
                                    />
                                )}
                            </Field>
                            <Field name={'synchronization_updates_synchronization_page_size'} initialValue={settings.synchronization_updates_synchronization_page_size}>
                                {({ input, meta }) => (
                                    <Input
                                        {...input}
                                        label={"Page size"}
                                        type={"number"}
                                        placeholder={"100"}
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


export default TabSynchronization;