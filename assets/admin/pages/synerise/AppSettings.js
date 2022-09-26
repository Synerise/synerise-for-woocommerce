import React, {useEffect, useState} from "react";
import { Form } from 'react-final-form';
import {Title} from "@synerise/ds-typography";
import Button from "@synerise/ds-button";
import PageHeader from "@synerise/ds-page-header";
import Tabs from "@synerise/ds-tabs";
import Layout from "@synerise/ds-layout";
import Grid from "@synerise/ds-grid";
import message from '@synerise/ds-message';
import CardSkeleton from "../../components/CardSkeleton";
import "./style.css";
import {SettingsTabs} from "../../config/constants";

const AppSettings = ({ getSettings, updateSettings }) => {
	const [isLoading, setIsLoading] = useState(true);
	const [isSaving, setIsSaving] = useState(false);
	const [activeTab, setTab] = useState(0);
	const [settings, setSettings] = useState({});
	const currentTab = SettingsTabs[activeTab];

	let submit;

	const saveSettings = (values, form) => {
		let dirtyFields = form.getState().dirtyFields;
		dirtyFields = Object.keys(dirtyFields);

		if(!dirtyFields.length){
			message.info('Nothing changed.');
			return;
		}

		let keyValueArray = Object.entries(values);

		let newValues = keyValueArray.filter((array) => {
			const [key, value] = array;
			if(dirtyFields.includes(key)){
				return true;
			}
			return false;
		});

		newValues = Object.fromEntries(new Map(newValues));

		setIsSaving(true);
		updateSettings('settings', newValues).then((response) => {
			setIsSaving(false);
			message.success('Your settings have been saved successfully.');
		});
	}

	const ActiveTab = currentTab.render;

	useEffect(() => {
		getSettings('settings').then((response) => {
			setSettings(response);
			setIsLoading(false);
		});
	}, [getSettings]);

	const validate = (values, form) => {
		let errors = [];

		if(values.data_catalog_name && (values.data_catalog_name.includes(' ') || values.data_catalog_name.includes('_')) ){
			errors.data_catalog_name = "Cannot contain \"_\" and space characters";
		}

		return errors;
	}

	return (
		<>
			<Layout
				fullPage={true}
				className={'synerise-layout'}
				header={
					<PageHeader
						isolated
						title={<Title level={3}>Settings configuration page</Title>}
						tabs={
							<Tabs
								block={true}
								activeTab={activeTab}
								tabs={SettingsTabs}
								handleTabClick={setTab}
							/>
						}
						rightSide={
							<>
								<Button
									style={{minWidth: "120px"}}
									type={"custom-color"}
									loading={isSaving}
									disabled={isSaving || isLoading}
									onClick={event => {
										submit(event)
									}}
									color={"fern"}>Save</Button>
							</>
						}

					/>
				}
			>
				<Grid
					style={{ padding: "36px 15px 0"}}
				>
					<Grid.Item
						contentWrapper
						xs={8}
						sm={8}
						md={12}
						lg={16}
						xl={12}
						xxl={12}
					>
						{isLoading ? <CardSkeleton /> : (
							<Form
								onSubmit={saveSettings}
								validate={validate}
								render={
									({ valid, values, handleSubmit, form, submitting }) => {
										submit = handleSubmit
										return ( <ActiveTab settings={settings} values={values} form={form} /> )
									}
								}
							/>
						)}
					</Grid.Item>
				</Grid>

			</Layout>
		</>
	);
}


export default AppSettings;