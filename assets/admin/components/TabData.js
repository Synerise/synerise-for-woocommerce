import React from "react";
import { Field } from 'react-final-form';
import { CardGroup } from "@synerise/ds-card";
import Form from "@synerise/ds-form";
import { Input } from "@synerise/ds-input";
import Select from '@synerise/ds-select';
import Grid from "@synerise/ds-grid";
import Card from "../components/Card";
import {inCardGridProps} from "../config/constants";

const TabData = ({settings, values, form}) => {

    return(
        <CardGroup>
            <Card
                localKey={"synerise-data-products-card"}
                withHeader={true}
                lively={true}
                title={"Products"}
            >
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'data_products_enabled'} initialValue={settings.data_products_enabled}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Enabled"}
                                        style={{ marginBottom: 12 }}
                                        placeholder="Select option"
                                        defaultValue={settings.data_products_enabled}
                                        onChange={(value, option) => { form.change(input.name, value) }}
                                    >
                                        <Select.Option key="true" value={true}>Yes</Select.Option>
                                        <Select.Option key="false" value={false}>No</Select.Option>
                                    </Select>
                                )}
                            </Field>
                            <Field name={'data_products_attributes'} initialValue={settings.data_products_attributes}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Attributes"}
                                        defaultValue={() => {
                                            return settings.data_products_attributes ? settings.data_products_attributes.map((event) => {
                                                return event.label
                                            }) : null;
                                        }}
                                        placeholder="Select attributes"
                                        description={"The changes of attribute selection will apply only to products which haven’t been sent to Synerise yet. To apply the changes to all products go to Marketing > Synerise > Dashboard and use Resend all items option."}
                                        mode={"multiple"}
                                        onChange={(values, options) => {
                                            form.change(input.name, options.map((option) => {
                                                return {
                                                    value: option.data,
                                                    label: option.value,
                                                    type: option.type
                                                }
                                            }));
                                        }}
                                    >
                                        {
                                            settings.data_products_attributes_list ? settings.data_products_attributes_list.map((attr) => {
                                                return (<Select.Option value={attr.label} data={attr.value} type={attr.type} />)
                                            }) : undefined
                                        }
                                    </Select>
                                )}
                            </Field>
                        </Form.FieldSet>
                    </Grid.Item>
                </Grid>
            </Card>
            <Card
                localKey={"synerise-data-customers-card"}
                withHeader={true}
                lively={true}
                title={"Customers"}
            >
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'data_customers_enabled'} initialValue={settings.data_customers_enabled}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Enabled"}
                                        style={{ marginBottom: 12 }}
                                        placeholder="Select option"
                                        defaultValue={settings.data_customers_enabled}
                                        onChange={(value, option) => {
                                            form.change(input.name, value);
                                        }}
                                    >
                                        <Select.Option key="true" value={true}>Yes</Select.Option>
                                        <Select.Option key="false" value={false}>No</Select.Option>
                                    </Select>
                                )}
                            </Field>
                        </Form.FieldSet>
                    </Grid.Item>
                </Grid>
            </Card>
            <Card
                localKey={"synerise-data-orders-card"}
                withHeader={true}
                lively={true}
                title={"Orders"}
            >
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'data_orders_enabled'} initialValue={settings.data_orders_enabled}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Enabled"}
                                        style={{ marginBottom: 12 }}
                                        placeholder="Select option"
                                        defaultValue={settings.data_orders_enabled}
                                        onChange={(value, option) => {
                                            form.change(input.name, value);
                                        }}
                                    >
                                        <Select.Option key="true" value={true}>Yes</Select.Option>
                                        <Select.Option key="false" value={false}>No</Select.Option>
                                    </Select>
                                )}
                            </Field>
                        </Form.FieldSet>
                    </Grid.Item>
                </Grid>
            </Card>
            <Card
                localKey={"synerise-data-catalog-card"}
                withHeader={true}
                lively={true}
                title={"Catalog"}
            >
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'data_catalog_name'} initialValue={settings.data_catalog_name}>
                                {({ input, meta }) => (
                                    <>
                                        <Input
                                            {...input}
                                            label={"Catalog Name"}
                                            placeholder={"Shop1"}
                                        />
                                        {meta.error && meta.touched && <span style={{color: "#ff0000"}}>{meta.error}</span>}
                                    </>
                                )}
                            </Field>
                        </Form.FieldSet>
                    </Grid.Item>
                </Grid>
            </Card>
        </CardGroup>
    );
}


export default TabData;