import React from "react";

export default function HorizontalInput({label, children, required = false}: HorizontalInputProps) {
    return (
        <div className="mb-3 row">
            <label className="col-sm-2 col-form-label" children={(
                <span>{label} {required && (<strong className="text-danger">*</strong>)}</span>
            )}/>
            <div className="col-sm-10" children={children}/>
        </div>
    );
}

type HorizontalInputProps = {
    label: string,
    children: React.ReactNode,
    required?: boolean,
};
