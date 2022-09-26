import React, { useEffect, useState } from "react";
import { Field } from 'react-final-form';
import { CardGroup } from "@synerise/ds-card";
import Form from "@synerise/ds-form";
import { Input } from "@synerise/ds-input";
import Select from '@synerise/ds-select';
import Grid from "@synerise/ds-grid";
import Card from "../components/Card";
import {inCardGridProps} from "../config/constants";

const TabSyneriseApi = ({settings, values, form}) => {

    return(
        <CardGroup>
            <Card
                localKey={"synerise-api-setup-card"}
                withHeader={true}
                lively={true}
                title={"Synerise API Setup"}
            >
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'synerise_api_key'} initialValue={settings.synerise_api_key}>
                                {({ input, meta }) => (
                                    <Input
                                        {...input}
                                        label={"Api Key"}
                                        type={"text"}
                                    />
                                )}
                            </Field>
                            <div>Api keys can be generated in Synerise application under <a
                                href="https://app.synerise.com/spa/modules/settings/apikeys/list"
                                target="_blank">Settings &gt; API Keys</a>.<br/><small>Create a <i>Business
                                Profile</i> api key with appropriate permissions.</small>
                            </div>
                            <Field name={'synerise_api_host_url'} initialValue={settings.synerise_api_host_url}>
                                {({ input, meta }) => (
                                    <Input
                                        {...input}
                                        label={"Host"}
                                        type={"url"}
                                        description={"Specify Api host URL."}
                                        placeholder={"https://api.synerise.com"}
                                    />
                                )}
                            </Field>
                        </Form.FieldSet>
                    </Grid.Item>
                </Grid>
            </Card>
            <Card
                localKey={"request-logging-card"}
                withHeader={true}
                lively={true}
                title={"Requests logging"}
            >
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'request_logging_enabled'} initialValue={settings.request_logging_enabled}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Enabled"}
                                        style={{ marginBottom: 12 }}
                                        defaultValue={settings.request_logging_enabled}
                                        onChange={(value, option) => {
                                            form.change(input.name, value);
                                        }}
                                    >
                                        <Select.Option value={true}>Yes</Select.Option>
                                        <Select.Option value={false}>No</Select.Option>
                                    </Select>
                                )}
                            </Field>
                        </Form.FieldSet>
                    </Grid.Item>
                </Grid>
            </Card>
        </CardGroup>
    );
}


export default TabSyneriseApi;