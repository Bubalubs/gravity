<template>
    <div class="text-editor">
        <textarea
            :name="name"
            style="display: none"
            v-model="content"
        >
        </textarea>

        <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
            <div class="menubar">
                <button
                    class="button"
                    :class="{ 'is-active': isActive.bold() }"
                    @click.prevent="commands.bold"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18.287 11.121c1.588-1.121 2.713-3.018 2.713-5.093 0-2.946-1.918-5.951-7.093-6.028h-11.907v2.042c1.996 0 3 .751 3 2.683v14.667c0 1.689-.558 2.608-3 2.608v2h11.123c6.334 0 8.877-3.599 8.877-7.038 0-2.538-1.417-4.67-3.713-5.841zm-8.287-8.121h2.094c2.357 0 4.126 1.063 4.126 3.375 0 2.035-1.452 3.625-3.513 3.625h-2.707v-7zm2.701 18h-2.701v-8h2.781c2.26.024 3.927 1.636 3.927 3.667 0 2.008-1.226 4.333-4.007 4.333z"/></svg>
                </button>

                <button
                    class="button"
                    :class="{ 'is-active': isActive.italic() }"
                    @click.prevent="commands.italic"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M9.565 20.827c-.361.732-.068 1.173.655 1.173h1.78v2h-9v-2h.897c1.356 0 1.673-.916 2.157-1.773l8.349-16.89c.403-.852-.149-1.337-.855-1.337h-1.548v-2h9v2h-.84c-1.169 0-1.596.646-2.06 1.516l-8.535 17.311z"/></svg>
                </button>

                <button
                    class="button"
                    :class="{ 'is-active': isActive.underline() }"
                    @click.prevent="commands.underline"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 24h-16v-2h16v2zm-5-24v1.973c1.619 0 2 .926 2 1.497v9.056c0 2.822-2.161 4.507-5 4.507s-5-1.685-5-4.507v-9.056c0-.571.381-1.497 2-1.497v-1.973h-7v1.973c1.66 0 2 .575 2 1.497v8.828c0 5.175 3.096 7.702 8 7.702 4.899 0 8-2.527 8-7.702v-8.828c0-.922.34-1.497 2-1.497v-1.973h-7z"/></svg>
                </button>

                <button
                    class="button"
                    :class="{ 'is-active': isActive.heading({ level: 1 }) }"
                    @click.prevent="commands.heading({ level: 1 })"
                >
                    H1
                </button>

                <button
                    class="button"
                    :class="{ 'is-active': isActive.heading({ level: 2 }) }"
                    @click.prevent="commands.heading({ level: 2 })"
                >
                    H2
                </button>

                <button
                    class="button"
                    :class="{ 'is-active': isActive.heading({ level: 3 }) }"
                    @click.prevent="commands.heading({ level: 3 })"
                >
                    H3
                </button>

                <button
                    class="button"
                    :class="{ 'is-active': isActive.heading({ level: 4 }) }"
                    @click.prevent="commands.heading({ level: 4 })"
                >
                    H4
                </button>

                <button
                    class="button"
                    :class="{ 'is-active': isActive.bullet_list() }"
                    @click.prevent="commands.bullet_list"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7 1h17v2h-17v-2zm0 7h17v-2h-17v2zm0 5h17v-2h-17v2zm0 5h17v-2h-17v2zm0 5h17v-2h-17v2zm-5-22c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 9c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 9c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"/></svg>
                </button>

                <button
                    class="button"
                    @click.prevent="commands.horizontal_rule"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8 14h-8v-2h8.672l-.672 2zm-8 10v-8h24v8h-24zm2-2h20v-4h-2v2h-1v-2h-2v3h-1v-3h-2v2h-1v-2h-2v2h-1v-2h-2v3h-1v-3h-2v2h-1v-2h-2v4zm9.398-12.26l-1.398 4.26 4.227-1.432-2.829-2.828zm9.774-9.74l2.828 2.828-8.587 8.554-2.828-2.828 8.587-8.554z"/></svg>
                </button>

                <button
                    class="button"
                    @click.prevent="commands.undo"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18.885 3.515c-4.617-4.618-12.056-4.676-16.756-.195l-2.129-2.258v7.938h7.484l-2.066-2.191c2.82-2.706 7.297-2.676 10.073.1 4.341 4.341 1.737 12.291-5.491 12.291v4.8c3.708 0 6.614-1.244 8.885-3.515 4.686-4.686 4.686-12.284 0-16.97z"/></svg>
                </button>

                <button
                    class="button"
                    @click.prevent="commands.redo"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5.115 3.515c4.617-4.618 12.056-4.676 16.756-.195l2.129-2.258v7.938h-7.484l2.066-2.191c-2.82-2.706-7.297-2.676-10.073.1-4.341 4.341-1.737 12.291 5.491 12.291v4.8c-3.708 0-6.614-1.244-8.885-3.515-4.686-4.686-4.686-12.284 0-16.97z"/></svg>
                </button>

                <div v-if="showInfoHelperButtons">
                    <button class="button" style="width:auto;margin-top:3px" @click.prevent="addListItem('WIFI')">WIFI</button>
                    <button class="button" style="width:auto;margin-top:3px" @click.prevent="addListItem('TV/DVD/CD player')">TV/DVD/CD player</button>
                    <button class="button" style="width:auto;margin-top:3px" @click.prevent="addListItem('Dishwasher')">Dishwasher</button>
                    <button class="button" style="width:auto;margin-top:3px" @click.prevent="addListItem('Washing machine')">Washing machine</button>
                    <button class="button" style="width:auto;margin-top:3px" @click.prevent="addListItem('Tumble dryer')">Tumble dryer</button>
                    <button class="button" style="width:auto;margin-top:3px" @click.prevent="addListItem('Bedding and towels included')">Bedding and towels</button>
                    <button class="button" style="width:auto;margin-top:3px" @click.prevent="addListItem('Garden with BBQ and patio furniture')">BBQ</button>
                    <button class="button" style="width:auto;margin-top:3px" @click.prevent="addListItem('Cleaning materials included')">Cleaning materials</button>
                    <button class="button" style="width:auto;margin-top:3px" @click.prevent="addListItem('Complimentary Welcome Hamper')">Welcome Hamper</button>
                    <button class="button" style="width:auto;margin-top:3px" @click.prevent="addListItem('Dogs welcome but subject to approval')">Dogs Welcome</button>
                </div>
            </div>
        </editor-menu-bar>

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

        <editor-content class="content" :editor="editor" />
    </div>
</template>

<script>
    import { Editor, EditorContent, EditorMenuBar, EditorMenuBubble } from 'tiptap';
    import {
        HardBreak,
        Heading,
        HorizontalRule,
        OrderedList,
        BulletList,
        ListItem,
        Bold,
        Italic,
        Link,
        Underline,
        History,
    } from 'tiptap-extensions';

    export default {
        props: [
            'name',
            'placeholder',
            'value',
            'showInfoHelperButtons'
        ],
        
        components: {
            EditorContent,
            EditorMenuBar,
            EditorMenuBubble
        },

        data() {
            return {
                editor: new Editor({
                    extensions: [
                        new BulletList(),
                        new HardBreak(),
                        new Heading({ levels: [1, 2, 3] }),
                        new HorizontalRule(),
                        new ListItem(),
                        new Link(),
                        new Bold(),
                        new Italic(),
                        new Underline(),
                        new History(),
                    ],
                    onUpdate: (newContent) => {;
                        this.content = newContent.getHTML();
                    },
                    content: this.content
                }),
                content: '',
                linkUrl: null,
                linkMenuIsActive: false
            }
        },

        mounted() {
            if (this.value) {    
                this.content = this.value;
                this.editor.setContent(this.content);
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