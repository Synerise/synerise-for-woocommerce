import React from "react";
import { Field } from 'react-final-form';
import { CardGroup } from "@synerise/ds-card";
import Form from "@synerise/ds-form";
import { Input } from '@synerise/ds-input';
import ManageableList from "@synerise/ds-manageable-list";
import Switch from "@synerise/ds-switch";
import Select from '@synerise/ds-select';
import Grid from "@synerise/ds-grid"
import Card from "../components/Card";
import {inCardGridProps} from "../config/constants";

import '../../styles/manageable-list.css';
import styles from '../../styles/TabOptIn.module.css';

const TabOptIn = ({settings, values, form}) => {

    return(
        <CardGroup>
            <Card
                localKey={"synerise-data-opt-in-card"}
                withHeader={true}
                lively={true}
                title={"OptIn"}
            >
                <Grid>
                    <Grid.Item
                        contentWrapper
                        {...inCardGridProps}
                    >
                        <Form.FieldSet>
                            <Field name={'opt_in'} initialValue={settings.opt_in ? settings.opt_in : 0}>
                                {({ input, meta }) => (
                                    <Select
                                        label={"Opt In Mode"}
                                        style={{ marginBottom: 12 }}
                                        placeholder="Select option"
                                        defaultValue={settings.opt_in ? settings.opt_in : 0}
                                        onChange={(value, option) => { form.change(input.name, value) }}
                                    >
                                        { settings.opt_in_mode_list && settings.opt_in_mode_list.map((mode) => {
                                            return (<Select.Option value={mode.mode}>{mode.label}</Select.Option>)
                                        }) }
                                    </Select>
                                )}
                            </Field>
                            { (values.opt_in !== 0) && (
                            <>
                                <p className={styles['sectionTitle']}>Marketing Agreements</p>
                                <div className={styles.flexRow}>
                                    <Field
                                        name={'opt_in_email_marketing_agreement_enabled'}
                                        initialValue={settings.opt_in_email_marketing_agreement_enabled ?
                                                      settings.opt_in_email_marketing_agreement_enabled : false}>
                                        {({ input, meta }) => (
                                            <Switch
                                                label={'Email Marketing Agreement'}
                                                defaultChecked={input.value}
                                                onChange={(checked) => {form.change(input.name, checked)}}
                                            />
                                        )}
                                    </Field>
                                    <Field
                                        name={'opt_in_sms_marketing_agreement_enabled'}
                                        initialValue={settings.opt_in_sms_marketing_agreement_enabled ?
                                            settings.opt_in_sms_marketing_agreement_enabled : false}>
                                        {({ input, meta }) => (
                                            <Switch
                                                style={{marginLeft: '30px'}}
                                                label={'SMS Marketing Agreement'}
                                                defaultChecked={input.value}
                                                onChange={(checked) => {form.change(input.name, checked)}}
                                            />
                                        )}
                                    </Field>
                                </div>
                            </>

                            )}

                            { (values.opt_in === 1) && (
                                <>
                                    <ManageableList
                                        className={styles.ManageableList}
                                        type="content"
                                        loading={false}
                                        maxToShowItems={2}
                                        onItemSelect={() => undefined}
                                        expandedIds={['0']}
                                        expanderDisabled={false}
                                        items={[
                                            {
                                                id: '0',
                                                name: 'Metadata mapping',
                                                canUpdate: false,
                                                canDelete: false,
                                                content: (
                                                    <div className={styles.fieldsRow}>
                                                        <div className={styles.field}>
                                                            <p className={styles.fieldName}>Customer metadata:</p>
                                                            <Field name={'opt_in_mapping_customer_email_agreement'} initialValue={settings.opt_in_mapping_email_agreement}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'Email marketing agreement metadata name'} placeholder={'customer_agreement_email'} />
                                                                )}
                                                            </Field>
                                                            <Field name={'opt_in_mapping_customer_sms_agreement'} initialValue={settings.opt_in_mapping_customer_sms_agreement}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'SMS marketing agreement metadata name'} placeholder={'customer_agreement_sms'} />
                                                                )}
                                                            </Field>
                                                        </div>
                                                        <div className={styles.divider}/>
                                                        <div className={styles.field}>
                                                            <p className={styles.fieldName}>Order metadata:</p>
                                                            <Field name={'opt_in_mapping_order_email_agreement'} initialValue={settings.opt_in_mapping_order_email_agreement}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'Email marketing agreement metadata name'} placeholder={'_order_agreement_email'}/>
                                                                )}
                                                            </Field>
                                                            <Field name={'opt_in_mapping_order_sms_agreement'} initialValue={settings.opt_in_mapping_order_sms_agreement}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'SMS marketing agreement metadata name'} placeholder={'_order_agreement_sms'}/>
                                                                )}
                                                            </Field>
                                                        </div>
                                                    </div>
                                                ),
                                            },
                                        ]}
                                    />
                                </>
                            )}

                            { (values.opt_in !== 0 && values.opt_in !== 1 && (values.opt_in === 4 || values.opt_in === 5)) && (
                                <>
                                    <ManageableList
                                        className={styles.ManageableList}
                                        type="content"
                                        loading={false}
                                        maxToShowItems={2}
                                        onItemSelect={() => undefined}
                                        expandedIds={['0']}
                                        expanderDisabled={false}
                                        items={[
                                            {
                                                id: '0',
                                                name: 'Checkout fields properties',
                                                canUpdate: false,
                                                canDelete: false,
                                                content: (
                                                    <div className={styles.fieldsRow}>
                                                        <div className={styles.field}>
                                                            <p className={styles.fieldName}>SMS marketing agreement</p>
                                                            <Field name={'opt_in_checkout_agreement_sms_label'} initialValue={settings.opt_in_checkout_agreement_sms_label}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'Label'} placeholder={'SMS marketing'} />
                                                                )}
                                                            </Field>
                                                            <Field name={'opt_in_checkout_agreement_sms_classes'} initialValue={settings.opt_in_checkout_agreement_sms_classes}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'Field classes'} placeholder={'form-row-wide contact-field'} />
                                                                )}
                                                            </Field>
                                                            <Field name={'opt_in_checkout_agreement_sms_required'} initialValue={settings.opt_in_checkout_agreement_sms_required ? settings.opt_in_checkout_agreement_sms_required : false}>
                                                                {({ input, meta }) => (
                                                                    <Switch defaultChecked={input.value} label={'Is this agreement required'} onChange={(checked) => {form.change(input.name, checked)}} />
                                                                )}
                                                            </Field>
                                                        </div>
                                                        <div className={styles.divider}/>
                                                        <div className={styles.field}>
                                                            <p className={styles.fieldName}>Email marketing agreement</p>
                                                            <Field name={'opt_in_checkout_agreement_email_label'} initialValue={settings.opt_in_checkout_agreement_email_label}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'Label'} placeholder={'Email marketing'} />
                                                                )}
                                                            </Field>
                                                            <Field name={'opt_in_checkout_agreement_email_classes'} initialValue={settings.opt_in_checkout_agreement_email_classes}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'Field classes'} placeholder={'form-row-wide contact-field'} />
                                                                )}
                                                            </Field>
                                                            <Field name={'opt_in_checkout_agreement_email_required'} initialValue={settings.opt_in_checkout_agreement_email_required ? settings.opt_in_checkout_agreement_email_required : false}>
                                                                {({ input, meta }) => (
                                                                    <Switch defaultChecked={input.value} label={'Is this agreement required'} onChange={(checked) => {form.change(input.name, checked)}} />
                                                                )}
                                                            </Field>
                                                        </div>
                                                    </div>
                                                ),
                                            },
                                        ]}
                                    />
                                </>
                            )}
                            { (values.opt_in !== 0 && values.opt_in !== 1 && (values.opt_in === 3 || values.opt_in === 5)) && (
                                <>
                                    <ManageableList
                                        className={styles.ManageableList}
                                        type="content"
                                        loading={false}
                                        maxToShowItems={2}
                                        onItemSelect={() => undefined}
                                        expandedIds={['0']}
                                        expanderDisabled={false}
                                        items={[
                                            {
                                                id: '0',
                                                name: 'Register fields properties',
                                                canUpdate: false,
                                                canDelete: false,
                                                content: (
                                                    <div className={styles.fieldsRow}>
                                                        <div className={styles.field}>
                                                            <p className={styles.fieldName}>SMS marketing agreement</p>
                                                            <Field name={'opt_in_register_agreement_sms_label'} initialValue={settings.opt_in_register_agreement_sms_label}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'Label'} placeholder={'SMS marketing'} />
                                                                )}
                                                            </Field>
                                                            <Field name={'opt_in_register_agreement_sms_classes'} initialValue={settings.opt_in_register_agreement_sms_classes}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'Field classes'} placeholder={'form-row-wide contact-field'} />
                                                                )}
                                                            </Field>
                                                            <Field name={'opt_in_register_agreement_sms_required'} initialValue={settings.opt_in_register_agreement_sms_required ? settings.opt_in_register_agreement_sms_required : false}>
                                                                {({ input, meta }) => (
                                                                    <Switch defaultChecked={input.value} label={'Is this agreement required'} onChange={(checked) => {form.change(input.name, checked)}} />
                                                                )}
                                                            </Field>
                                                        </div>
                                                        <div className={styles.divider}/>
                                                        <div className={styles.field}>
                                                            <p className={styles.fieldName}>Email marketing agreement</p>
                                                            <Field name={'opt_in_register_agreement_email_label'} initialValue={settings.opt_in_register_agreement_email_label}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'Label'} placeholder={'Email marketing'} />
                                                                )}
                                                            </Field>
                                                            <Field name={'opt_in_register_agreement_email_classes'} initialValue={settings.opt_in_register_agreement_email_classes}>
                                                                {({ input, meta }) => (
                                                                    <Input {...input} type={'text'} label={'Field classes'} placeholder={'form-row-wide contact-field'} />
                                                                )}
                                                            </Field>
                                                            <Field name={'opt_in_register_agreement_email_required'} initialValue={settings.opt_in_register_agreement_email_required ? settings.opt_in_register_agreement_email_required : false}>
                                                                {({ input, meta }) => (
                                                                    <Switch defaultChecked={input.value} label={'Is this agreement required'} onChange={(checked) => {form.change(input.name, checked)}} />
                                                                )}
                                                            </Field>
                                                        </div>
                                                    </div>
                                                ),
                                            },
                                        ]}
                                    />
                                </>
                            )}
                        </Form.FieldSet>
                    </Grid.Item>
                </Grid>
            </Card>
        </CardGroup>
    );
}


export default TabOptIn;