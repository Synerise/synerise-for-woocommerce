import React from "react";
import { Field } from 'react-final-form';
import { CardGroup } from "@synerise/ds-card";
import Form from "@synerise/ds-form";
import Select from '@synerise/ds-select';
import Grid from "@synerise/ds-grid";
import Card from "../components/Card";
import {inCardGridProps} from "../config/constants";

const TabEventTracking = ({settings, values, form}) => {

    return(
        <CardGroup>
            <Card
                localKey="event-tracking-card"
                withHeader={true}
                lively={true}
                title={"Events"}
            >
                <div>Events either provide data for live tracking of customer actions or for background updates synchronization. In general it is recommended keep all events enabled, unless you intend to provide some types of data in an alternative way.</div>
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'event_tracking_enabled'} initialValue={settings.event_tracking_enabled}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Enabled"}
                                        style={{ marginBottom: 12 }}
                                        defaultValue={settings.event_tracking_enabled}
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
                                        placeholder={"Select options"}
                                        mode={"multiple"}
                                        defaultValue={() => {
                                            return settings.event_tracking_events ? settings.event_tracking_events.map((event) => {
                                                return event.label
                                            }) : null;
                                        }}
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
                                            settings.event_tracking_events_list ? settings.event_tracking_events_list.map((event) => {
                                                return (<Select.Option value={event.label} data={event.action} />)
                                            }) : undefined
                                        }
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


export default TabEventTracking;