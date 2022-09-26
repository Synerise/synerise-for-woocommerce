import React, { useEffect, useState } from "react";
import {Input} from "@synerise/ds-input";
import { Field } from 'react-final-form';

const StepAPI = ({values, form, defaultData}) => {

    return(
        <>
                <Field
                    name={'synerise_api_key'}
                >
                    {({ input, meta }) => (
                        <>
                            <Input
                                {...input}
                                className={"w-100"}
                                label={"Api Key"}
                                type={"text"}
                                name={"synerise_api_key"}
                            />
                            {meta.touched && meta.error && <span>{meta.error}</span>}
                            <div>Api keys can be generated in Synerise application under <a
                                href="https://app.synerise.com/spa/modules/settings/apikeys/list"
                                target="_blank">Settings &gt; API Keys</a>.<br/><small>Create a <i>Business
                                Profile</i> api key with appropriate permissions.</small></div>
                        </>
                    )}
                </Field>
                <Field
                    name={'synerise_api_host_url'}
                    initialValue={defaultData.synerise_api_host_url}
                >
                    {({ input, meta }) => (
                    <>
                        <Input
                            {...input}
                            className={"w-100"}
                            label={"Host"}
                            type={"url"}
                            placeholder={"https://api.synerise.com"}
                            name={"synerise_api_host_url"}
                        />
                        {meta.touched && meta.error && <span>{meta.error}</span>}
                        <div>Specify Api host URL.</div>
                    </>
                    )}
                </Field>
        </>
    )
}

export default StepAPI;