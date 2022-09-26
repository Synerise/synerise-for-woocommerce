import {default as DSCard} from '@synerise/ds-card';
import React, {useState, useEffect} from "react";
import Button from "@synerise/ds-button";

const Card = ({withHeader = false, title = "", lively= false, localKey, children}) => {
    const [hideContent, setHideContent] = useState(() => {
        const saved = localStorage.getItem(localKey);
        const initialValue = JSON.parse(saved);
        return initialValue || false;
    });
    const onHeaderClick = React.useMemo(() => {
        return () => {
            setHideContent(!hideContent);
        };
    }, [hideContent, setHideContent]);

    useEffect(() => {
        localStorage.setItem(localKey, JSON.stringify(hideContent));
    }, [hideContent]);

    return (
      <DSCard
          hideContent={hideContent}
          headerSideChildren={
              <div>
                  <Button.Expander expanded={hideContent} onClick={onHeaderClick} size={"M"}/>
              </div>
          }
          withHeader={withHeader}
          lively={lively}
          title={title}
          onHeaderClick={onHeaderClick}
      >
          {children}
      </DSCard>
    );

}

export default Card;