const inputName = (i) => {
    return `  <div class="col-span-2 w-full mt-2">
        <label class="form-control w-full max-w-xs" for="loggingNameCategory${i}">
            <div class="label">
                <div>
                    <span class="label-text text-black dark:text-white">Name</span>
                    <span class="text-error">*</span>
                </div>
            </div>
        </label>

        <label class="input input-bordered w-full text-xs md:text-base flex items-center bg-white dark:bg-black border border-primary focus:border-primary">
            <input id="loggingNameCategory${i}" type="text"
                class="grow border-none outline-none " name="items[` + i + `][name]" x-model="form.items[` + i + `].name"
                value="" placeholder="Item name"
                minlength="1" maxlength="50" />
        </label>

        <template x-if="isSubmitFormItem && form.items[` + i + `].name">
        <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
        </template>

        <template x-if="isSubmitFormItem && !form.items[` + i + `].name">
        <p class="mt-2 text-error text-xs">Please fill the Name</p>
        </template>
        </div>
        `
}


const inputCategory = (i) => {
    return ` <div class="col-span-2 w-full mt-2">
        <label class="form-control w-full max-w-xs" for="loggingItemCategory${i}">
        <div class="label">
        <div>
        <span class="label-text text-black dark:text-white">Item Category</span>
        <span class="text-error">*</span>
        </div>
        </div>
        </label>

        <label class="input input-bordered w-full text-xs md:text-base flex items-center bg-white dark:bg-black border border-primary focus:border-primary">
        <select id="loggingItemCategory${i}" class="grow border-none outline-none text-md font-extralight bg-white dark:bg-black border border-primary focus:border-primary"
            name="items[` + i + `][category_name]" x-model="form.items[` + i + `].category_name">
            <option value="" selected disabled>Item category</option>
            <option value="material">Material
            </option>
            <option value="service">Service
            </option>
        </select>
        </label>
        <template x-if="isSubmitFormItem && form.items[` + i + `].category_name">
        <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
        </template>

        <template x-if="isSubmitFormItem && !form.items[` + i + `].category_name">
        <p class="mt-2 text-error text-xs">Please fill the Item Category</p>
        </template>
        </div>
    `
}


const inputPrice = (i) => {
    return `<div class="col-span-2 w-full mt-2">
        <label class="form-control w-full max-w-xs" for="loggingPrice${i}">
        <div class="label">
        <div>
        <span class="label-text text-black dark:text-white">Price</span>
        <span class="text-error">*</span>
        </div>
        </div>
        </label>

        <label class="input input-bordered w-full text-xs md:text-base flex items-center bg-white dark:bg-black border border-primary focus:border-primary ">
        <p class="text-sm text-gray-400">Rp.</p>
        <input id="loggingPrice${i}" type="text"
            class="grow border-none outline-none " name="items[` + i + `][price]"
            x-model="form.items[` + i + `].price" value="" placeholder="Item price" x-mask:dynamic="$money($input,',')" step="1000"
            minlength="1" maxlength="50" />
        </label>

        <template x-if="isSubmitFormItem && form.items[` + i + `].price && !isNaN(form.items[` + i + `].price)">
        <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
        </template>

        <template x-if="isSubmitFormItem && !form.items[` + i + `].price">
        <p class="mt-2 text-error text-xs">Please fill the Price</p>
        </template>

        <template x-if="isSubmitFormItem && form.items[` + i + `].price && isNaN(form.items[` + i + `].price)">
        <p class="mt-2 text-error text-xs">Price must be number</p>
        </template>
        </div>
    `
}

const buttonRemove = (i) => {
    return ` <div class="col-span-1 w-full mt-8">
        <button type="button" id=btn-remove-item-` + i + ` class="btn btn-sm btn-error text-white" x-on:click="removeItemForm(${i})">Remove</button>
        </div>`
}

const formParent = (i) => {

    return `
        <div class="grid lg:grid-cols-7 grid-cols-2 place-items-center place-content-center gap-4 border-t border-t-gray-800" id="formParent${i}">
        ${inputName(i)}
        ${inputCategory(i)}
        ${inputPrice(i)}
        ${buttonRemove(i)}

        </div>
        `;
}

