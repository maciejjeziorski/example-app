import React from "react";

export default function TextInput({name, register: ref, placeholder, error}: TextInputProps) {
    const hasError = !!error;

    return (
        <>
            <input type="text"
                   className={"form-control" + (hasError ? " is-invalid" : "")}
                   {...{name, ref, placeholder}}
            />

            {hasError && (
                <div className="invalid-feedback" children={error}/>
            )}
        </>
    );
}

type TextInputProps = {
    name: string,
    register: unknown,
    placeholder?: string,
    error: string | null,
};
