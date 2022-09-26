import React from "react";
import {default as DSCard} from '@synerise/ds-card';
import Button from "@synerise/ds-button";
import Skeleton from "@synerise/ds-skeleton";
import Grid from "@synerise/ds-grid";
import {inCardGridProps} from "../config/constants";

const CardSkeleton = () => {

    return (
        <DSCard
            className={'card-skeleton'}
            hideContent={false}
            headerSideChildren={
                <div>
                    <Button.Expander expanded={false} onClick={() => {}} size={"M"}/>
                </div>
            }
            withHeader={true}
            lively={true}
            title={<div style={{maxWidth: "420px", width: "100%"}}><Skeleton numberOfSkeletons={1} /></div>}
            onHeaderClick={() => {}}
        >
            <Grid>
                <Grid.Item
                    contentWrapper
                    {...inCardGridProps}
                >
                    <div style={{width: "100%", maxWidth: "140px", marginBottom: "15px", marginTop: "20px"}}>
                        <Skeleton numberOfSkeletons={1} />
                    </div>
                    <div style={{width: "100%", marginBottom: "15px"}}>
                        <Skeleton numberOfSkeletons={1} width={"L"} size={"L"}/>
                    </div>
                    <div style={{width: "100%", marginBottom: "5px"}}>
                        <Skeleton numberOfSkeletons={1} width={"L"} size={"S"}/>
                    </div>
                    <div style={{width: "50%", marginBottom: "15px"}}>
                        <Skeleton numberOfSkeletons={1} width={"L"} size={"S"}/>
                    </div>
                </Grid.Item>
            </Grid>
        </DSCard>
    );

}

export default CardSkeleton;