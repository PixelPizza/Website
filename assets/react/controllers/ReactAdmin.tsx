import { HydraAdmin } from "@api-platform/admin";
import React from 'react';

interface ReactAdminProps {
    entrypoint: string;
}

export default class ReactAdmin extends React.Component<ReactAdminProps> {
    render() {
        return (
            <HydraAdmin entrypoint={this.props.entrypoint} />
        );
    }
}