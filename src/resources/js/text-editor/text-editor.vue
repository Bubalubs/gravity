<template>
    <div class="text-editor">
        <textarea
            :name="name"
            style="display: none"
            v-model="content"
        >
        </textarea>

        <div v-if="editor">
            <div class="menubar">
                <button
                    class="button menubar-button"
                    :class="{ 'is-active': editor.isActive('bold') }"
                    @click="editor.chain().focus().toggleBold().run()"
                    v-tooltip="'Bold'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18.287 11.121c1.588-1.121 2.713-3.018 2.713-5.093 0-2.946-1.918-5.951-7.093-6.028h-11.907v2.042c1.996 0 3 .751 3 2.683v14.667c0 1.689-.558 2.608-3 2.608v2h11.123c6.334 0 8.877-3.599 8.877-7.038 0-2.538-1.417-4.67-3.713-5.841zm-8.287-8.121h2.094c2.357 0 4.126 1.063 4.126 3.375 0 2.035-1.452 3.625-3.513 3.625h-2.707v-7zm2.701 18h-2.701v-8h2.781c2.26.024 3.927 1.636 3.927 3.667 0 2.008-1.226 4.333-4.007 4.333z"/></svg>
                </button>

                <button
                    class="button menubar-button"
                    :class="{ 'is-active': editor.isActive('italic') }"
                    @click="editor.chain().focus().toggleItalic().run()"
                    v-tooltip="'Italic'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9.565 20.827c-.361.732-.068 1.173.655 1.173h1.78v2h-9v-2h.897c1.356 0 1.673-.916 2.157-1.773l8.349-16.89c.403-.852-.149-1.337-.855-1.337h-1.548v-2h9v2h-.84c-1.169 0-1.596.646-2.06 1.516l-8.535 17.311z"/></svg>
                </button>

                <button
                    class="button menubar-button"
                    :class="{ 'is-active': editor.isActive('underline') }"
                    @click="editor.chain().focus().toggleUnderline().run()"
                    v-tooltip="'Underline'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 24h-16v-2h16v2zm-5-24v1.973c1.619 0 2 .926 2 1.497v9.056c0 2.822-2.161 4.507-5 4.507s-5-1.685-5-4.507v-9.056c0-.571.381-1.497 2-1.497v-1.973h-7v1.973c1.66 0 2 .575 2 1.497v8.828c0 5.175 3.096 7.702 8 7.702 4.899 0 8-2.527 8-7.702v-8.828c0-.922.34-1.497 2-1.497v-1.973h-7z"/></svg>
                </button>

                <button
                    class="button menubar-button"
                    @click.prevent="toggleImageModal()"
                    v-tooltip="'Image'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><title>paginate-filter-picture-alternate</title><circle cx="9.75" cy="6.247" r="2.25"/><path d="M16.916,8.71A1.027,1.027,0,0,0,16,8.158a1.007,1.007,0,0,0-.892.586L13.55,12.178a.249.249,0,0,1-.422.053l-.82-1.024a1,1,0,0,0-.813-.376,1.007,1.007,0,0,0-.787.426L7.59,15.71A.5.5,0,0,0,8,16.5H20a.5.5,0,0,0,.425-.237.5.5,0,0,0,.022-.486Z"/><path d="M22,0H5.5a2,2,0,0,0-2,2V18.5a2,2,0,0,0,2,2H22a2,2,0,0,0,2-2V2A2,2,0,0,0,22,0Zm-.145,18.354a.5.5,0,0,1-.354.146H6a.5.5,0,0,1-.5-.5V2.5A.5.5,0,0,1,6,2H21.5a.5.5,0,0,1,.5.5V18A.5.5,0,0,1,21.855,18.351Z"/><path d="M19.5,22H2.5a.5.5,0,0,1-.5-.5V4.5a1,1,0,0,0-2,0V22a2,2,0,0,0,2,2H19.5a1,1,0,0,0,0-2Z"/></svg>
                </button>

                <button
                    class="button menubar-button"
                    :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
                    @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                    v-tooltip="'Header 1'"
                >
                    H1
                </button>

                <button
                    class="button menubar-button"
                    :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
                    @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                    v-tooltip="'Header 2'"
                >
                    H2
                </button>

                <button
                    class="button menubar-button"
                    :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }"
                    @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                    v-tooltip="'Header 3'"
                >
                    H3
                </button>

                <button
                    class="button menubar-button"
                    :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }"
                    @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
                    v-tooltip="'Header 4'"
                >
                    H4
                </button>

                <button
                    class="button menubar-button"
                    :class="{ 'is-active': isActive.bullet_list() }"
                    @click.prevent="commands.bullet_list"
                    v-tooltip="'Bullet List'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7 1h17v2h-17v-2zm0 7h17v-2h-17v2zm0 5h17v-2h-17v2zm0 5h17v-2h-17v2zm0 5h17v-2h-17v2zm-5-22c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 9c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 9c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"/></svg>
                </button>

                <button
                    class="button menubar-button"
                    :class="{ 'is-active': isActive.ordered_list() }"
                    @click.prevent="commands.ordered_list"
                    v-tooltip="'Ordered List'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512"><path fill="currentColor" d="M61.77 401l17.5-20.15a19.92 19.92 0 0 0 5.07-14.19v-3.31C84.34 356 80.5 352 73 352H16a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h22.84a154.82 154.82 0 0 0-11 12.31l-5.61 7c-4 5.07-5.25 10.13-2.8 14.88l1.05 1.93c3 5.76 6.3 7.88 12.25 7.88h4.73c10.33 0 15.94 2.44 15.94 9.09 0 4.72-4.2 8.22-14.36 8.22a41.54 41.54 0 0 1-15.47-3.12c-6.49-3.88-11.74-3.5-15.6 3.12l-5.59 9.31c-3.73 6.13-3.2 11.72 2.62 15.94 7.71 4.69 20.39 9.44 37 9.44 34.16 0 48.5-22.75 48.5-44.12-.03-14.38-9.12-29.76-28.73-34.88zM12.1 320H80a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8H41.33c3.28-10.29 48.33-18.68 48.33-56.44 0-29.06-25-39.56-44.47-39.56-21.36 0-33.8 10-40.45 18.75-4.38 5.59-3 10.84 2.79 15.37l8.58 6.88c5.61 4.56 11 2.47 16.13-2.44a13.4 13.4 0 0 1 9.45-3.84c3.33 0 9.28 1.56 9.28 8.75C51 248.19 0 257.31 0 304.59v4C0 316 5.08 320 12.1 320zM16 160h64a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8H64V40a8 8 0 0 0-8-8H32a8 8 0 0 0-7.14 4.42l-8 16A8 8 0 0 0 24 64h8v64H16a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8zm488-80H168a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h336a8 8 0 0 0 8-8V88a8 8 0 0 0-8-8zm0 320H168a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h336a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8zm0-160H168a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h336a8 8 0 0 0 8-8v-16a8 8 0 0 0-8-8z"></path></svg>
                </button>

                <button
                    class="button menubar-button"
                    @click.prevent="commands.horizontal_rule"
                    v-tooltip="'Horizontal Seperator'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8 14h-8v-2h8.672l-.672 2zm-8 10v-8h24v8h-24zm2-2h20v-4h-2v2h-1v-2h-2v3h-1v-3h-2v2h-1v-2h-2v2h-1v-2h-2v3h-1v-3h-2v2h-1v-2h-2v4zm9.398-12.26l-1.398 4.26 4.227-1.432-2.829-2.828zm9.774-9.74l2.828 2.828-8.587 8.554-2.828-2.828 8.587-8.554z"/></svg>
                </button>

                <button
                    class="button menubar-button"
                    @click.prevent="commands.undo"
                    v-tooltip="'Undo'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18.885 3.515c-4.617-4.618-12.056-4.676-16.756-.195l-2.129-2.258v7.938h7.484l-2.066-2.191c2.82-2.706 7.297-2.676 10.073.1 4.341 4.341 1.737 12.291-5.491 12.291v4.8c3.708 0 6.614-1.244 8.885-3.515 4.686-4.686 4.686-12.284 0-16.97z"/></svg>
                </button>

                <button
                    class="button menubar-button"
                    @click.prevent="commands.redo"
                    v-tooltip="'Redo'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5.115 3.515c4.617-4.618 12.056-4.676 16.756-.195l2.129-2.258v7.938h-7.484l2.066-2.191c-2.82-2.706-7.297-2.676-10.073.1-4.341 4.341-1.737 12.291 5.491 12.291v4.8c-3.708 0-6.614-1.244-8.885-3.515-4.686-4.686-4.686-12.284 0-16.97z"/></svg>
                </button>

                <button
                    class="button menubar-button"
                    @click.prevent="commands.createTable({rowsCount: 3, colsCount: 3, withHeaderRow: true })"
                    v-tooltip="'Create Table (3x3)'"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M17,17 L17,22 L19,22 C20.6568542,22 22,20.6568542 22,19 L22,17 L17,17 Z M15,17 L9,17 L9,22 L15,22 L15,17 Z M17,15 L22,15 L22,9 L17,9 L17,15 Z M15,15 L15,9 L9,9 L9,15 L15,15 Z M17,7 L22,7 L22,5 C22,3.34314575 20.6568542,2 19,2 L17,2 L17,7 Z M15,7 L15,2 L9,2 L9,7 L15,7 Z M24,16.1768671 L24,19 C24,21.7614237 21.7614237,24 19,24 L5,24 C2.23857625,24 2.11453371e-15,21.7614237 1.77635684e-15,19 L0,5 C-3.38176876e-16,2.23857625 2.23857625,2.28362215e-15 5,0 L19,0 C21.7614237,-5.07265313e-16 24,2.23857625 24,5 L24,7.82313285 C24.0122947,7.88054124 24.0187107,7.93964623 24.0187107,8 C24.0187107,8.06035377 24.0122947,8.11945876 24,8.17686715 L24,15.8231329 C24.0122947,15.8805412 24.0187107,15.9396462 24.0187107,16 C24.0187107,16.0603538 24.0122947,16.1194588 24,16.1768671 Z M7,2 L5,2 C3.34314575,2 2,3.34314575 2,5 L2,7 L7,7 L7,2 Z M2,9 L2,15 L7,15 L7,9 L2,9 Z M2,17 L2,19 C2,20.6568542 3.34314575,22 5,22 L7,22 L7,17 L2,17 Z"/></svg>
                </button>

                <span v-if="isActive.table()">
                    <button
                        class="button menubar-button"
                        @click.prevent="commands.deleteTable"
                        v-tooltip="'Delete Table'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19,14 C21.7600532,14.0033061 23.9966939,16.2399468 24,19 C24,21.7614237 21.7614237,24 19,24 C16.2385763,24 14,21.7614237 14,19 C14,16.2385763 16.2385763,14 19,14 Z M16.5,19.9375 L21.5,19.9375 C22.017767,19.9375 22.4375,19.517767 22.4375,19 C22.4375,18.482233 22.017767,18.0625 21.5,18.0625 L16.5,18.0625 C15.982233,18.0625 15.5625,18.482233 15.5625,19 C15.5625,19.517767 15.982233,19.9375 16.5,19.9375 Z M12.2898787,17 L9,17 L9,22 L12.6736312,22 C13.0297295,22.7496048 13.515133,23.4258795 14.1010173,24 L5,24 C2.23857625,24 -1.43817996e-15,21.7614237 -1.77635684e-15,19 L-3.55271368e-15,5 C-3.89089055e-15,2.23857625 2.23857625,5.07265313e-16 5,-1.77635684e-15 L19,-1.77635684e-15 C21.7614237,-2.28362215e-15 24,2.23857625 24,5 L24,7.82313285 C24.0122947,7.88054124 24.0187107,7.93964623 24.0187107,8 C24.0187107,8.06035377 24.0122947,8.11945876 24,8.17686715 L24,14.1010173 C23.4258795,13.515133 22.7496048,13.0297295 22,12.6736312 L22,9 L17,9 L17,12.2898787 C16.2775651,12.5048858 15.6040072,12.8333806 15,13.2546893 L15,9 L9,9 L9,15 L13.2546893,15 C12.8333806,15.6040072 12.5048858,16.2775651 12.2898787,17 Z M17,7 L22,7 L22,5 C22,3.34314575 20.6568542,2 19,2 L17,2 L17,7 Z M15,7 L15,2 L9,2 L9,7 L15,7 Z M7,2 L5,2 C3.34314575,2 2,3.34314575 2,5 L2,7 L7,7 L7,2 Z M2,9 L2,15 L7,15 L7,9 L2,9 Z M2,17 L2,19 C2,20.6568542 3.34314575,22 5,22 L7,22 L7,17 L2,17 Z"/></svg>
                    </button>

                    <button
                        class="button menubar-button"
                        @click.prevent="commands.addColumnBefore"
                        v-tooltip="'Table: Add Column Before'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19,14 C21.7600532,14.0033061 23.9966939,16.2399468 24,19 C24,21.7614237 21.7614237,24 19,24 C16.2385763,24 14,21.7614237 14,19 C14,16.2385763 16.2385763,14 19,14 Z M21.5,19.9375 C22.017767,19.9375 22.4375,19.517767 22.4375,19 C22.4375,18.482233 22.017767,18.0625 21.5,18.0625 L20.25,18.0625 C20.077411,18.0625 19.9375,17.922589 19.9375,17.75 L19.9375,16.5 C19.9375,15.982233 19.517767,15.5625 19,15.5625 C18.482233,15.5625 18.0625,15.982233 18.0625,16.5 L18.0625,17.75 C18.0625,17.922589 17.922589,18.0625 17.75,18.0625 L16.5,18.0625 C15.982233,18.0625 15.5625,18.482233 15.5625,19 C15.5625,19.517767 15.982233,19.9375 16.5,19.9375 L17.75,19.9375 C17.922589,19.9375 18.0625,20.077411 18.0625,20.25 L18.0625,21.5 C18.0625,22.017767 18.482233,22.4375 19,22.4375 C19.517767,22.4375 19.9375,22.017767 19.9375,21.5 L19.9375,20.25 C19.9375,20.077411 20.077411,19.9375 20.25,19.9375 L21.5,19.9375 Z M2,19 C2,20.6568542 3.34314575,22 5,22 C6.65685425,22 8,20.6568542 8,19 L8,5 C8,3.34314575 6.65685425,2 5,2 C3.34314575,2 2,3.34314575 2,5 L2,19 Z M-2.7585502e-16,19 L5.81397739e-16,5 C-1.37692243e-16,2.23857625 2.23857625,0 5,0 C7.76142375,0 10,2.23857625 10,5 L10,19 C10,21.7614237 7.76142375,24 5,24 C2.23857625,24 4.43234962e-16,21.7614237 -2.7585502e-16,19 Z"/></svg>
                    </button>

                    <button
                        class="button menubar-button"
                        @click.prevent="commands.addColumnAfter"
                        v-tooltip="'Table: Add Column After'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5,14 C7.76005315,14.0033061 9.99669388,16.2399468 10,19 C10,21.7614237 7.76142375,24 5,24 C2.23857625,24 1.77635684e-15,21.7614237 1.77635684e-15,19 C1.77635684e-15,16.2385763 2.23857625,14 5,14 Z M7.5,19.9375 C8.01776695,19.9375 8.4375,19.517767 8.4375,19 C8.4375,18.482233 8.01776695,18.0625 7.5,18.0625 L6.25,18.0625 C6.07741102,18.0625 5.9375,17.922589 5.9375,17.75 L5.9375,16.5 C5.9375,15.982233 5.51776695,15.5625 5,15.5625 C4.48223305,15.5625 4.0625,15.982233 4.0625,16.5 L4.0625,17.75 C4.0625,17.922589 3.92258898,18.0625 3.75,18.0625 L2.5,18.0625 C1.98223305,18.0625 1.5625,18.482233 1.5625,19 C1.5625,19.517767 1.98223305,19.9375 2.5,19.9375 L3.75,19.9375 C3.92258898,19.9375 4.0625,20.077411 4.0625,20.25 L4.0625,21.5 C4.0625,22.017767 4.48223305,22.4375 5,22.4375 C5.51776695,22.4375 5.9375,22.017767 5.9375,21.5 L5.9375,20.25 C5.9375,20.077411 6.07741102,19.9375 6.25,19.9375 L7.5,19.9375 Z M16,19 C16,20.6568542 17.3431458,22 19,22 C20.6568542,22 22,20.6568542 22,19 L22,5 C22,3.34314575 20.6568542,2 19,2 C17.3431458,2 16,3.34314575 16,5 L16,19 Z M14,19 L14,5 C14,2.23857625 16.2385763,0 19,0 C21.7614237,0 24,2.23857625 24,5 L24,19 C24,21.7614237 21.7614237,24 19,24 C16.2385763,24 14,21.7614237 14,19 Z"/></svg>
                    </button>

                    <button
                        class="button menubar-button"
                        @click.prevent="commands.deleteColumn"
                        v-tooltip="'Table: Delete Column'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.6414391,21.9312708 C12.9358807,22.5689168 13.3234155,23.1547532 13.7866134,23.6713497 C13.2317936,23.8836754 12.6294813,24 12,24 C9.23857625,24 7,21.7614237 7,19 L7,5 C7,2.23857625 9.23857625,0 12,0 C14.7614237,0 17,2.23857625 17,5 L17,12.2898787 C16.2775651,12.5048858 15.6040072,12.8333806 15,13.2546893 L15,5 C15,3.34314575 13.6568542,2 12,2 C10.3431458,2 9,3.34314575 9,5 L9,19 C9,20.6568542 10.3431458,22 12,22 C12.220157,22 12.4347751,21.9762852 12.6414391,21.9312708 Z M19,14 C21.7600532,14.0033061 23.9966939,16.2399468 24,19 C24,21.7614237 21.7614237,24 19,24 C16.2385763,24 14,21.7614237 14,19 C14,16.2385763 16.2385763,14 19,14 Z M16.5,19.9375 L21.5,19.9375 C22.017767,19.9375 22.4375,19.517767 22.4375,19 C22.4375,18.482233 22.017767,18.0625 21.5,18.0625 L16.5,18.0625 C15.982233,18.0625 15.5625,18.482233 15.5625,19 C15.5625,19.517767 15.982233,19.9375 16.5,19.9375 Z"/></svg>
                    </button>

                    <button
                        class="button menubar-button"
                        @click.prevent="commands.addRowBefore"
                        v-tooltip="'Table: Add Row Before'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19,14 C21.7600532,14.0033061 23.9966939,16.2399468 24,19 C24,21.7614237 21.7614237,24 19,24 C16.2385763,24 14,21.7614237 14,19 C14,16.2385763 16.2385763,14 19,14 Z M21.5,19.9375 C22.017767,19.9375 22.4375,19.517767 22.4375,19 C22.4375,18.482233 22.017767,18.0625 21.5,18.0625 L20.25,18.0625 C20.077411,18.0625 19.9375,17.922589 19.9375,17.75 L19.9375,16.5 C19.9375,15.982233 19.517767,15.5625 19,15.5625 C18.482233,15.5625 18.0625,15.982233 18.0625,16.5 L18.0625,17.75 C18.0625,17.922589 17.922589,18.0625 17.75,18.0625 L16.5,18.0625 C15.982233,18.0625 15.5625,18.482233 15.5625,19 C15.5625,19.517767 15.982233,19.9375 16.5,19.9375 L17.75,19.9375 C17.922589,19.9375 18.0625,20.077411 18.0625,20.25 L18.0625,21.5 C18.0625,22.017767 18.482233,22.4375 19,22.4375 C19.517767,22.4375 19.9375,22.017767 19.9375,21.5 L19.9375,20.25 C19.9375,20.077411 20.077411,19.9375 20.25,19.9375 L21.5,19.9375 Z M5,2 C3.34314575,2 2,3.34314575 2,5 C2,6.65685425 3.34314575,8 5,8 L19,8 C20.6568542,8 22,6.65685425 22,5 C22,3.34314575 20.6568542,2 19,2 L5,2 Z M5,0 L19,0 C21.7614237,-5.07265313e-16 24,2.23857625 24,5 C24,7.76142375 21.7614237,10 19,10 L5,10 C2.23857625,10 3.38176876e-16,7.76142375 0,5 C-1.2263553e-15,2.23857625 2.23857625,5.07265313e-16 5,0 Z"/></svg>
                    </button>

                    <button
                        class="button menubar-button"
                        @click.prevent="commands.addRowAfter"
                        v-tooltip="'Table: Add Row After'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19,0 C21.7600532,0.00330611633 23.9966939,2.23994685 24,5 C24,7.76142375 21.7614237,10 19,10 C16.2385763,10 14,7.76142375 14,5 C14,2.23857625 16.2385763,0 19,0 Z M21.5,5.9375 C22.017767,5.9375 22.4375,5.51776695 22.4375,5 C22.4375,4.48223305 22.017767,4.0625 21.5,4.0625 L20.25,4.0625 C20.077411,4.0625 19.9375,3.92258898 19.9375,3.75 L19.9375,2.5 C19.9375,1.98223305 19.517767,1.5625 19,1.5625 C18.482233,1.5625 18.0625,1.98223305 18.0625,2.5 L18.0625,3.75 C18.0625,3.92258898 17.922589,4.0625 17.75,4.0625 L16.5,4.0625 C15.982233,4.0625 15.5625,4.48223305 15.5625,5 C15.5625,5.51776695 15.982233,5.9375 16.5,5.9375 L17.75,5.9375 C17.922589,5.9375 18.0625,6.07741102 18.0625,6.25 L18.0625,7.5 C18.0625,8.01776695 18.482233,8.4375 19,8.4375 C19.517767,8.4375 19.9375,8.01776695 19.9375,7.5 L19.9375,6.25 C19.9375,6.07741102 20.077411,5.9375 20.25,5.9375 L21.5,5.9375 Z M5,16 C3.34314575,16 2,17.3431458 2,19 C2,20.6568542 3.34314575,22 5,22 L19,22 C20.6568542,22 22,20.6568542 22,19 C22,17.3431458 20.6568542,16 19,16 L5,16 Z M5,14 L19,14 C21.7614237,14 24,16.2385763 24,19 C24,21.7614237 21.7614237,24 19,24 L5,24 C2.23857625,24 3.38176876e-16,21.7614237 0,19 C-1.2263553e-15,16.2385763 2.23857625,14 5,14 Z"/></svg>
                    </button>

                    <button
                        class="button menubar-button"
                        @click.prevent="commands.deleteRow"
                        v-tooltip="'Table: Delete Row'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.2546893,15 C12.8333806,15.6040072 12.5048858,16.2775651 12.2898787,17 L5,17 C2.23857625,17 3.38176876e-16,14.7614237 0,12 C-1.2263553e-15,9.23857625 2.23857625,7 5,7 L19,7 C21.7614237,7 24,9.23857625 24,12 C24,12.6294813 23.8836754,13.2317936 23.6713497,13.7866134 C23.1547532,13.3234155 22.5689168,12.9358807 21.9312708,12.6414391 C21.9762852,12.4347751 22,12.220157 22,12 C22,10.3431458 20.6568542,9 19,9 L5,9 C3.34314575,9 2,10.3431458 2,12 C2,13.6568542 3.34314575,15 5,15 L13.2546893,15 Z M19,14 C21.7600532,14.0033061 23.9966939,16.2399468 24,19 C24,21.7614237 21.7614237,24 19,24 C16.2385763,24 14,21.7614237 14,19 C14,16.2385763 16.2385763,14 19,14 Z M16.5,19.9375 L21.5,19.9375 C22.017767,19.9375 22.4375,19.517767 22.4375,19 C22.4375,18.482233 22.017767,18.0625 21.5,18.0625 L16.5,18.0625 C15.982233,18.0625 15.5625,18.482233 15.5625,19 C15.5625,19.517767 15.982233,19.9375 16.5,19.9375 Z"/></svg>
                    </button>

                    <button
                        class="button menubar-button"
                        @click.prevent="commands.toggleCellMerge"
                        v-tooltip="'Table: Toggle Cell Merge'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M2,19 C2,20.6568542 3.34314575,22 5,22 L19,22 C20.6568542,22 22,20.6568542 22,19 L22,5 C22,3.34314575 20.6568542,2 19,2 L5,2 C3.34314575,2 2,3.34314575 2,5 L2,19 Z M-1.16403344e-15,19 L-3.0678068e-16,5 C-6.44957556e-16,2.23857625 2.23857625,0 5,0 L19,0 C21.7614237,0 24,2.23857625 24,5 L24,19 C24,21.7614237 21.7614237,24 19,24 L5,24 C2.23857625,24 9.50500275e-16,21.7614237 -1.16403344e-15,19 Z M12,10 C12.5522847,10 13,10.4477153 13,11 L13,13 C13,13.5522847 12.5522847,14 12,14 C11.4477153,14 11,13.5522847 11,13 L11,11 C11,10.4477153 11.4477153,10 12,10 Z M12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 C13,20.5522847 12.5522847,21 12,21 C11.4477153,21 11,20.5522847 11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 Z M12,3 C12.5522847,3 13,3.44771525 13,4 L13,7 C13,7.55228475 12.5522847,8 12,8 C11.4477153,8 11,7.55228475 11,7 L11,4 C11,3.44771525 11.4477153,3 12,3 Z"/></svg>
                    </button>
                </span>
            </div>
        </div>

        <editor-menu-bubble class="menububble" :editor="editor" @hide="hideLinkMenu" v-slot="{ commands, isActive, getMarkAttrs, menu }">
            <div
                class="menububble"
                :class="{ 'is-active': menu.isActive }"
                :style="`left: ${menu.left}px; bottom: ${menu.bottom}px;`"
            >
                <form class="menububble__form" v-if="linkMenuIsActive" @submit.prevent="setLinkUrl(commands.link, linkUrl)">
                    <input class="menububble__input" type="text" v-model="linkUrl" placeholder="https://" ref="linkInput" @keydown.esc="hideLinkMenu"/>
                    <button class="menububble__button" @click="setLinkUrl(commands.link, null)" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fff" d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.538l-4.592-4.548 4.546-4.587-1.416-1.403-4.545 4.589-4.588-4.543-1.405 1.405 4.593 4.552-4.547 4.592 1.405 1.405 4.555-4.596 4.591 4.55 1.403-1.416z"/></svg>
                    </button>
                </form>

                <template v-else>
                    <button
                        class="menububble__button"
                        @click="showLinkMenu(getMarkAttrs('link'))"
                        :class="{ 'is-active': isActive.link() }"
                    >
                        <span style="margin-right:4px">{{ isActive.link() ? 'Update Link' : 'Add Link'}}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path fill="#fff" d="M6.188 8.719c.439-.439.926-.801 1.444-1.087 2.887-1.591 6.589-.745 8.445 2.069l-2.246 2.245c-.644-1.469-2.243-2.305-3.834-1.949-.599.134-1.168.433-1.633.898l-4.304 4.306c-1.307 1.307-1.307 3.433 0 4.74 1.307 1.307 3.433 1.307 4.74 0l1.327-1.327c1.207.479 2.501.67 3.779.575l-2.929 2.929c-2.511 2.511-6.582 2.511-9.093 0s-2.511-6.582 0-9.093l4.304-4.306zm6.836-6.836l-2.929 2.929c1.277-.096 2.572.096 3.779.574l1.326-1.326c1.307-1.307 3.433-1.307 4.74 0 1.307 1.307 1.307 3.433 0 4.74l-4.305 4.305c-1.311 1.311-3.44 1.3-4.74 0-.303-.303-.564-.68-.727-1.051l-2.246 2.245c.236.358.481.667.796.982.812.812 1.846 1.417 3.036 1.704 1.542.371 3.194.166 4.613-.617.518-.286 1.005-.648 1.444-1.087l4.304-4.305c2.512-2.511 2.512-6.582.001-9.093-2.511-2.51-6.581-2.51-9.092 0z"/></svg>
                    </button>
                </template>
            </div>
        </editor-menu-bubble>

        <modal
            :is-active="showImageLibraryModal"
            @close="toggleImageModal()"
        >
            <media-library
                @select-media="addImage"
            >
            </media-library>
        </modal>

        <editor-content class="content" :editor="editor" />
    </div>
</template>

<script>
    // import { Editor, EditorContent, EditorMenuBar, EditorMenuBubble } from 'tiptap';
    // import {
    //     HardBreak,
    //     Heading,
    //     HorizontalRule,
    //     Bold,
    //     Italic,
    //     Link,
    //     Underline,
    //     Image,
    //     History,
	// 	Table,
	// 	TableHeader,
	// 	TableCell,
	// 	TableRow
    // } from 'tiptap-extensions';
    
    // TODO: is this needed?
    // import Iframe from './Iframe.js';

    import { Editor, EditorContent } from '@tiptap/vue-2';
    import Document from '@tiptap/extension-document';
    import Paragraph from '@tiptap/extension-paragraph';
    import Text from '@tiptap/extension-text';
    import BulletList from '@tiptap/extension-bullet-list';
    import OrderedList from '@tiptap/extension-ordered-list';
    import ListItem from '@tiptap/extension-list-item';
    import Heading from '@tiptap/extension-heading'

    import MediaLibrary from '../media-library.vue';
    import Modal from '../modal.vue';

    export default {
        props: [
            'name',
            'placeholder',
            'value'
        ],
        
        components: {
            Modal,
            MediaLibrary,
            EditorContent,
            // EditorMenuBubble
        },

        data() {
            return {
                editor: new Editor({
                    extensions: [
                        StarterKit,
                        Document,
                        Paragraph,
                        Text,
                        ListItem,
                        BulletList,
                        // new HardBreak(),
                        Heading.configure({
                            levels: [1, 2, 3, 4],
                        }),
                        // new HorizontalRule(),
                        // new BulletList(),
                        OrderedList,
                        // new Link(),
                        // new Bold(),
                        // new Italic(),
                        // new Underline(),
                        // new Image(),
                        // new History(),
                        // new Iframe(),
						// new Table({
						// 	resizable: true,
						// }),
						// new TableHeader(),
						// new TableCell(),
						// new TableRow()
                    ],
                    content: this.content,
                    onUpdate: () => {
                        this.content = this.editor.getHTML();
                    },
                }),
                content: '',
                linkUrl: null,
                linkMenuIsActive: false,
                showImageLibraryModal: false
            }
        },

        mounted() {
            if (this.value) {    
                this.content = this.value;
                this.editor.commands.setContent(this.content);
            }
        },

        methods: {
            showLinkMenu(attrs) {
                this.linkUrl = attrs.href;
                this.linkMenuIsActive = true;

                this.$nextTick(() => {
                    this.$refs.linkInput.focus();
                })
            },

            hideLinkMenu() {
                this.linkUrl = null;
                this.linkMenuIsActive = false;
            },

            setLinkUrl(command, url) {
                command({ href: url });
                this.hideLinkMenu();
            },

            addListItem(item) {
                let updatedContent = this.content;

                updatedContent = updatedContent.replace('</ul>', '<li>' + item + '</li></ul>');

                this.editor.setContent(updatedContent);
                this.content = updatedContent;
            },

            toggleImageModal() {
                this.showImageLibraryModal = !this.showImageLibraryModal;
            },

            addImage(path) {
                if (path !== null) {
                    this.editor.commands.image({ src: path })
                    this.toggleImageModal();
                }
            }
        },

        watch: {
            content: function (value) {
                this.$emit('updated', value);
            }
        },

        beforeDestroy() {
            this.editor.destroy();
        }
    }
</script>