import React, {useEffect, useState} from "react";
import Layout from "@synerise/ds-layout";
import Wizard from "@synerise/ds-wizard";
import Card from "@synerise/ds-card";
import { Form } from 'react-final-form';
import Stepper from "@synerise/ds-stepper";
import Loader from "@synerise/ds-loader";
import message from '@synerise/ds-message';
import "./style.css";
import Grid from "@synerise/ds-grid";
import { WizardSteps } from "../../config/constants";

const AppWizard = ({getSettings, updateSettings}) => {
	const [isLoading, setIsLoading] = useState(true);
	const [defaultData, setDefaultData] = useState(null);
	const [isSaving, setSaving] = React.useState(false);
	const [activeStep, setActiveStep] = React.useState(0);
	const currentStep = WizardSteps[activeStep];
	const totalStepsCount = WizardSteps.length - 1;

	message.config({
		top: 35,
		duration: 3,
		maxCount: 3
	});

	const Child = currentStep.render;

	const saveSetting = async (data) => {
		setSaving(true);
		return await updateSettings('settings', data)
			.then(() => {
				setSaving(false);
				return true;
			}).catch(() => {
				setSaving(false);
				message.error('Settings not saved');
				return false;
			}).finally(() => {
				setSaving(false);
			});
	}

	const validateApiKey = async (key, host) => {
		return await updateSettings('validate-api-key', {apiKey: key, apiHost: host})
			.catch(error => {
				message.error(error.message);
				return false;
			}).then(response => {
				return response.success === true;
			});
	}

	const validate = (values) => {
		const errors = {};

		if (!values.synerise_api_host_url) {
			errors.synerise_api_host_url = 'Required';
		}
		if (!values.synerise_api_key) {
			errors.synerise_api_key = 'Required';
		}
		if(typeof variable !== 'undefined' && !values.data_catalog_name) {
			errors.data_catalog_name = 'Required';
		}

		return errors;
	};

	const onPrevious = () => {
		setActiveStep(activeStep - 1);
	}

	const onSubmit = () => {};


	const redirectToDashboard = () => {
		window.location.href = window.rest.dashboard_url;
	}

	useEffect(() => {
		getSettings('settings/defaults').then(response => {
				setDefaultData(response);
				setIsLoading(false);
			});
	}, [getSettings]);

	return (
		<>
			<Layout
				fullPage={true}
				className={'synerise-layout dashboard'}
			>
				<Grid
					style={{ padding: "36px 15px 0"}}
				>
					<Grid.Item
						contentWrapper
						xs={8}
						sm={8}
						md={12}
						lg={12}
						xl={12}
						xxl={12}
					>
						{ isLoading ? (
							<Loader label={"Loading..."}/>
						) : (
						<Card lively={true}>
								<Form
									onSubmit={onSubmit}
									validate={validate}
									render={
										({ valid, values, handleSubmit, form, submitting }) => {
											useEffect(() => {
												console.log(values);
											}, [values]);

											const onNext = async () => {
												if (!valid) {
													return handleSubmit();
												}

												if(activeStep === 0){
													const isKeyValid = await validateApiKey(values.synerise_api_key, values.synerise_api_host_url)
													if(!isKeyValid){
														return handleSubmit();
													}
												}

												const saved = await saveSetting(values);
												if(!saved){
													return handleSubmit();
												}

												if (activeStep < totalStepsCount) {
													return setActiveStep(activeStep + 1);
												}

												if(activeStep === totalStepsCount) {
													redirectToDashboard();
												}
											};
											return (
												<Wizard
													visible={true}
													title={'Synerise Plugin Wizard'}
													onPrevStep={activeStep !== 0 && !isSaving ? onPrevious : undefined}
													onNextStep={!isSaving ? onNext : undefined}
													stepper={
														<Stepper orientation="horizontal">
															{WizardSteps.map((step, i) => (
																<Stepper.Step
																	key={step.id}
																	label={step.label}
																	stepNumber={i + 1}
																	active={activeStep === i}
																	done={i < activeStep}
																	validated={false}
																/>
															))}
														</Stepper>
													}
													texts={{
														prevButtonLabel: "Previous",
														nextButtonLabel: activeStep === totalStepsCount ? 'Finish' : "Next step",
													}}
												>
													{ isLoading ? undefined : (<Child values={values} form={form} defaultData={defaultData} />) }
												</Wizard>
											);
										}
									}
								/>
						</Card>
						)}
					</Grid.Item>
				</Grid>
			</Layout>
		</>
	);
}


export default AppWizard;