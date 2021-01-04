import React from "react";

export default function TextareaInput({name, register: ref, placeholder, error, rows = 3}: TextareaInputProps) {
    const hasError = !!error;

    return (
        <>
            <textarea className={"form-control" + (hasError ? " is-invalid" : "")}
                      {...{name, ref, placeholder, rows}}
            />

            {hasError && (
                <div className="invalid-feedback" children={error}/>
            )}
        </>
    );
}

type TextareaInputProps = {
    name: string,
    register: unknown,
    placeholder?: string,
    rows?: number,
    error: string | null,
};
