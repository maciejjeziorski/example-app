import React from "react";
import HorizontalInput from "../components/HorizontalInput";
import {Input} from "../components/Input";
import FormButtons from "../components/FormButtons";
import {useAppForm, UseAppFormProps} from "../hooks/useAppForm";

export default function TaskForm(
    {submitMethod, submitUrl, initUrl, redirectPath, cancelPath, submitButtonLabel}: TaskFormProps
) {
    const {register, errors, handleSubmit, onSubmit, initData} = useAppForm({
        submitMethod,
        submitUrl,
        initUrl,
        redirectPath,
    });

    return (
        <form className="my-5" onSubmit={handleSubmit(onSubmit)}>
            <HorizontalInput label="Title" required children={(
                <Input.Text name="title"
                            error={errors?.title?.message || null}
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

            <HorizontalInput label="Priority" required children={(
                <Input.Select name="priority"
                              error={errors?.priority?.message || null}
                              options={initData?.config_data?.priorities || []}
                              register={register}
                />
            )}/>

            <HorizontalInput label="Status" required children={(
                <Input.Select name="status"
                              error={errors?.status?.message || null}
                              options={initData?.config_data?.statuses || []}
                              register={register}
                />
            )}/>

            <HorizontalInput label="Due date" children={(
                <Input.Date name="due_date"
                            error={errors?.due_date?.message || null}
                            register={register}
                />
            )}/>

            <FormButtons cancelPath={cancelPath}
                         submitLabel={submitButtonLabel}
            />
        </form>
    );
}

type TaskFormProps = {
    cancelPath: string,
    submitButtonLabel: string,
} & UseAppFormProps;
