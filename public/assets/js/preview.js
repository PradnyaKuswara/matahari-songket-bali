class Preview {
    setInputNode(id) {
        this.inputNode = document.getElementById(id);
        return this;
    }
    createImageNode(style) {
        this.nodeImage = document.createElement("img");
        this.nodeImage.setAttribute("class", style);
        return this;
    }
    setImageNode(id) {
        this.nodeImage = document.getElementById(id);
        return this;
    }
    setParentNode(id) {
        this.parentNode = document.getElementById(id);
        return this;
    }
    set() {
        this.inputNode.addEventListener("change", () => {
            const file = this.inputNode.files[0];
            if (file) {
                this.parentNode.appendChild(this.nodeImage);
                this.nodeImage.src = URL.createObjectURL(file);
            }
        });
    }
    removeImageNode() {
        this.nodeImage.remove();
    }
}
