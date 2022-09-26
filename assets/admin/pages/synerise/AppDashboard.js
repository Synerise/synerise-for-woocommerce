import React, {useEffect, useState} from "react";
import {Title} from "@synerise/ds-typography";
import PageHeader from "@synerise/ds-page-header";
import Layout from "@synerise/ds-layout";
import Grid from "@synerise/ds-grid";
import Card from "@synerise/ds-card";
import Button from "@synerise/ds-button";
import "./style.css";
import Skeleton from "@synerise/ds-skeleton";
import message from "@synerise/ds-message";

const AppDashboard = ({getSettings, updateSettings}) => {
	const [synchronization, setSynchronization] = useState({});
	const [isLoading, setIsLoading] = useState(true);

	message.config({
		top: 35,
		duration: 3,
		maxCount: 3
	});

	useEffect(() => {
		load();
	}, [getSettings]);

	const load = () => {
		getSettings('synchronization').then((response) => {
			setSynchronization(response);
			setIsLoading(false);
		});
	}

	const resendItems = async (model) => {
		await updateSettings('synchronization/resend', {model: model})
			.then((response) => {
				message.success('Synchronization has been successfully restarted');
				setIsLoading(true);
				load();
			})
			.catch((error) => {
				message.error('Synchronization restart failed');
			});
	}

	const sendAdditionalItems = async (model) => {
		return await updateSettings('synchronization/send-additional', {model: model})
			.then((response) => {
				message.success('Synchronization has been successfully restarted');
			})
			.catch((error) => {
				message.error('Synchronization restart failed');
			});
	}

	const gridProps = {
		xs: 8,
		sm: 8,
		md: 4,
		lg: 4,
		xl: 5,
		xxl: 8
	};

	const buttonGridProps = {
		xs: 4,
		sm: 4,
		md: 4,
		lg: 6,
		xl: 8
	};

	return (
		<>
			<Layout
				fullPage={true}
				className={'synerise-layout dashboard'}
				header={
					<PageHeader
						isolated
						title={<Title level={3}>Integration Dashboard</Title>}
					/>
				}
			>
				<Grid style={{padding: '36px 15px 0 15px'}}>
					<Grid.Item
						contentWrapper
						xs={8}
						sm={8}
						md={8}
						lg={12}
						xl={16}
						xxl={24}
					>
						<Grid>
							<Grid.Item
								{...gridProps}
							>
								<Card lively={true}
									  withHeader={true}
									  title={"Catalog status"}
									  description={"Products sent"}
									  headerSideChildren={
										  isLoading ? (
											  <div style={{width: "70px"}}><Skeleton style={{margin: 0}} size={'L'} numberOfSkeletons={1}/></div>
										  ) : (
											  <Title level={2}>{synchronization.products.synchronized}/{synchronization.products.total}</Title>
										  )
									  }
								>
									<Grid gutter={20}>
										<Grid.Item {...buttonGridProps}>
											<Button
												disabled={isLoading}
												type="ghost-primary"
												onClick={() => {resendItems('product')}}
											>
												Resend all items
											</Button>
										</Grid.Item>
										<Grid.Item {...buttonGridProps}>
											<Button
												disabled={isLoading}
												type="ghost-primary"
												onClick={() => {sendAdditionalItems('product')}}
											>
												Send additional
											</Button>
										</Grid.Item>
									</Grid>
								</Card>
							</Grid.Item>
							<Grid.Item
								{...gridProps}
							>
								<Card lively={true}
									  withHeader={true}
									  title={"Customers status"}
									  description={"Customers sent"}
									  headerSideChildren={
										  isLoading ? (
											  <div style={{width: "70px"}}><Skeleton style={{margin: 0}} size={'L'} numberOfSkeletons={1}/></div>
										  ) : (
											  <Title level={2}>{synchronization.customers.synchronized}/{synchronization.customers.total}</Title>
										  )
									  }
								>
									<Grid gutter={20}>
										<Grid.Item {...buttonGridProps}>
											<Button
												disabled={isLoading}
												type="ghost-primary"
												onClick={() => {resendItems('customer')}}
											>
												Resend all items
											</Button>
										</Grid.Item>
										<Grid.Item {...buttonGridProps}>
											<Button
												disabled={isLoading}
												type="ghost-primary"
												onClick={() => {sendAdditionalItems('customer')}}
											>
												Send additional
											</Button>
										</Grid.Item>
									</Grid>
								</Card>
							</Grid.Item>
							<Grid.Item
								{...gridProps}
							>
								<Card lively={true}
									  withHeader={true}
									  title={"Orders status"}
									  description={"Orders sent"}
									  headerSideChildren={
										  isLoading ? (
											  <div style={{width: "70px"}}><Skeleton style={{margin: 0}} size={'L'} numberOfSkeletons={1}/></div>
										  ) : (
											  <Title level={2}>{synchronization.orders.synchronized}/{synchronization.orders.total}</Title>
										  )
									  }
								>
									<Grid gutter={20}>
										<Grid.Item {...buttonGridProps}>
											<Button
												disabled={isLoading}
												type="ghost-primary"
												onClick={() => {resendItems('order')}}
											>
												Resend all items
											</Button>
										</Grid.Item>
										<Grid.Item {...buttonGridProps}>
											<Button
												disabled={isLoading}
												type="ghost-primary"
												onClick={() => {sendAdditionalItems('order')}}
											>
												Send additional
											</Button>
										</Grid.Item>
									</Grid>
								</Card>
							</Grid.Item>
						</Grid>
					</Grid.Item>
				</Grid>

			</Layout>
		</>
	);
}


export default AppDashboard;