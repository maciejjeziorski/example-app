import React from "react";
import HorizontalInput from "../components/HorizontalInput";
import {Input} from "../components/Input";
import FormButtons from "../components/FormButtons";
import {useAppForm, UseAppFormProps} from "../hooks/useAppForm";

export default function ProjectForm(
    {submitMethod, submitUrl, initUrl, redirectPath, cancelPath, submitButtonLabel}: ProjectFormProps
) {
    const {register, errors, handleSubmit, onSubmit} = useAppForm({
        submitMethod,
        submitUrl,
        initUrl,
        redirectPath,
    });

    return (
        <form className="my-5" onSubmit={handleSubmit(onSubmit)}>
            <HorizontalInput label="Name" required children={(
                <Input.Text name="name"
                            error={errors?.name?.message || null}
                            register={register}
                />
            )}/>

            <HorizontalInput label="Description" children={(
                <Input.Textarea name="description"
                                error={errors?.description?.message || null}
                                rows={5}
                                register={register}
                />
            )}/>

            <HorizontalInput label="Client" children={(
                <Input.Text name="client"
                            error={errors?.client?.message || null}
                            register={register}
                />
            )}/>

            <FormButtons cancelPath={cancelPath}
                         submitLabel={submitButtonLabel}
            />
        </form>
    );
}

type ProjectFormProps = {
    cancelPath: string,
    submitButtonLabel: string,
} & UseAppFormProps;
