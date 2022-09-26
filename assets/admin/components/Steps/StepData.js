import React from "react";
import { Field } from 'react-final-form';
import Select from "@synerise/ds-select";
import Divider from "@synerise/ds-divider";
import {Input, TextArea} from "@synerise/ds-input";
import {Title} from "@synerise/ds-typography";

const StepData = ({values, form = null, defaultData}) => {


    return(
        <>
                <Title level={3} style={{marginBottom: "12px"}}>Products</Title>
                <Field name={'data_products_enabled'} initialValue={defaultData.data_products_enabled}>
                    {({ input, meta }) => (
                        <>
                            <Select
                                {...input}
                                className={'w-100'}
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

            <Field name={'data_products_attributes'} initialValue={defaultData.data_products_attributes}>
                {({ input, meta }) => (
                    <Select
                        label={"Attributes"}
                        className={'w-100'}
                        placeholder={"Select options"}
                        mode={"multiple"}
                        disabled={!values.data_products_enabled}
                        defaultValue={() => {
                            return defaultData.data_products_attributes ? defaultData.data_products_attributes.map((event) => {
                                return event.label
                            }) : null;
                        }}
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
                            defaultData.data_products_attributes_list.map((attr) => {
                                return (<Select.Option value={attr.label} data={attr.value} type={attr.type} />)
                            })
                        }
                    </Select>
                )}
            </Field>

            <Divider
                marginBottom={24}
                marginTop={24}
                orientation="center"
            />

            <Title level={3} style={{marginBottom: "12px"}}>Customers</Title>
            <Field name={'data_customers_enabled'} initialValue={defaultData.data_customers_enabled}>
                {({ input, meta }) => (
                <Select
                    label={"Enabled"}
                    className={'w-100'}
                    style={{ marginBottom: 12 }}
                    placeholder="Select option"
                    defaultValue={defaultData.data_customers_enabled}
                    onChange={(value, option) => {
                        form.change(input.name, value);
                    }}
                >
                    <Select.Option key="true" value={true}>Yes</Select.Option>
                    <Select.Option key="false" value={false}>No</Select.Option>
                </Select>
                )}
            </Field>

            <Divider
                marginBottom={24}
                marginTop={24}
                orientation="center"
            />

            <Title level={3} style={{marginBottom: "12px"}}>Orders</Title>
            <Field name={'data_orders_enabled'} initialValue={defaultData.data_orders_enabled}>
                {({ input, meta }) => (
                <Select
                    label={"Enabled"}
                    className={'w-100'}
                    style={{ marginBottom: 12 }}
                    placeholder="Select option"
                    defaultValue={defaultData.data_orders_enabled}
                    onChange={(value, option) => {
                        form.change(input.name, value);
                    }}
                >
                    <Select.Option key="true" value={true}>Yes</Select.Option>
                    <Select.Option key="false" value={false}>No</Select.Option>
                </Select>
                )}
            </Field>

            <Divider
                marginBottom={24}
                marginTop={24}
                orientation="center"
            />

            <Title level={3} style={{marginBottom: "12px"}}>Catalog</Title>
            <Field name={'data_catalog_name'} initialValue={defaultData.data_catalog_name}>
                {({ input, meta }) => (
                    <Input
                        {...input}
                        label={"Catalog Name"}
                        className={'w-100'}
                        placeholder={"Shop"}
                    />
                )}
            </Field>
        </>
    )
}

export default StepData;