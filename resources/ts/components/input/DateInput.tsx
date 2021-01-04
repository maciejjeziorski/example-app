import React from "react";

export default function DateInput({name, register: ref, placeholder, error}: DateInputProps) {
    const hasError = !!error;

    return (
        <>
            <input type="date"
                   className={"form-control" + (hasError ? " is-invalid" : "")}
                   {...{name, ref, placeholder}}
            />

            {hasError && (
                <div className="invalid-feedback" children={error}/>
            )}
        </>
    );
}

type DateInputProps = {
    name: string,
    register: unknown,
    placeholder?: string,
    error: string | null,
};
