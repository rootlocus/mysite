<template>
  <div v-if="editor">
    <div class="flex flex-col md:flex-row md:space-x-2">
      <input
        type="color"
        @input="editor.chain().focus().setColor($event.target.value).run()"
        :value="editor.getAttributes('textStyle').color"
        class="border-0.5 border-black rounded bg-white"
      />
      <!-- <button class="rounded bg-white p-1 hover:bg-gray-300" @click="editor.chain().focus().unsetColor().run()">
            remove color
            </button> -->
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleBold().run()"
        :class="{ 'bg-gray-300': editor.isActive('bold') }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M8 11h4.5a2.5 2.5 0 1 0 0-5H8v5zm10 4.5a4.5 4.5 0 0 1-4.5 4.5H6V4h6.5a4.5 4.5 0 0 1 3.256 7.606A4.498 4.498 0 0 1 18 15.5zM8 13v5h5.5a2.5 2.5 0 1 0 0-5H8z"
          />
        </svg>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleItalic().run()"
        :class="{ 'bg-gray-300': editor.isActive('italic') }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path d="M15 20H7v-2h2.927l2.116-12H9V4h8v2h-2.927l-2.116 12H15z" />
        </svg>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleUnderline().run()"
        :class="{ 'bg-gray-300': editor.isActive('underline') }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M8 3v9a4 4 0 1 0 8 0V3h2v9a6 6 0 1 1-12 0V3h2zM4 20h16v2H4v-2z"
          />
        </svg>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleStrike().run()"
        :class="{ 'bg-gray-300': editor.isActive('strike') }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M17.154 14c.23.516.346 1.09.346 1.72 0 1.342-.524 2.392-1.571 3.147C14.88 19.622 13.433 20 11.586 20c-1.64 0-3.263-.381-4.87-1.144V16.6c1.52.877 3.075 1.316 4.666 1.316 2.551 0 3.83-.732 3.839-2.197a2.21 2.21 0 0 0-.648-1.603l-.12-.117H3v-2h18v2h-3.846zm-4.078-3H7.629a4.086 4.086 0 0 1-.481-.522C6.716 9.92 6.5 9.246 6.5 8.452c0-1.236.466-2.287 1.397-3.153C8.83 4.433 10.271 4 12.222 4c1.471 0 2.879.328 4.222.984v2.152c-1.2-.687-2.515-1.03-3.946-1.03-2.48 0-3.719.782-3.719 2.346 0 .42.218.786.654 1.099.436.313.974.562 1.613.75.62.18 1.297.414 2.03.699z"
          />
        </svg>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleCode().run()"
        :class="{ 'bg-gray-300': editor.isActive('code') }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M23 12l-7.071 7.071-1.414-1.414L20.172 12l-5.657-5.657 1.414-1.414L23 12zM3.828 12l5.657 5.657-1.414 1.414L1 12l7.071-7.071 1.414 1.414L3.828 12z"
          />
        </svg>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().unsetAllMarks().run()"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M12.651 14.065L11.605 20H9.574l1.35-7.661-7.41-7.41L4.93 3.515 20.485 19.07l-1.414 1.414-6.42-6.42zm-.878-6.535l.27-1.53h-1.8l-2-2H20v2h-5.927L13.5 9.257 11.773 7.53z"
          />
        </svg>
      </button>
      <!-- <button class="rounded bg-white p-1 hover:bg-gray-300" @click="editor.chain().focus().clearNodes().run()">
                clear node
            </button> -->
      <!-- <button class="rounded bg-white p-1 hover:bg-gray-300" @click="editor.chain().focus().setParagraph().run()" :class="{ 'bg-gray-300': editor.isActive('paragraph') }">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 6v15h-2v-5a6 6 0 1 1 0-12h10v2h-3v15h-2V6h-3zm-2 0a4 4 0 1 0 0 8V6z"/></svg>
            </button> -->
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
        :class="{ 'bg-gray-300': editor.isActive('heading', { level: 1 }) }"
      >
        <span class="font-extrabold">H1</span>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
        :class="{ 'bg-gray-300': editor.isActive('heading', { level: 2 }) }"
      >
        <span class="font-extrabold">H2</span>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
        :class="{ 'bg-gray-300': editor.isActive('heading', { level: 3 }) }"
      >
        <span class="font-extrabold">H3</span>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleHeading({ level: 4 }).run()"
        :class="{ 'bg-gray-300': editor.isActive('heading', { level: 4 }) }"
      >
        <span class="font-extrabold">H4</span>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleHeading({ level: 5 }).run()"
        :class="{ 'bg-gray-300': editor.isActive('heading', { level: 5 }) }"
      >
        <span class="font-extrabold">H5</span>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleHeading({ level: 6 }).run()"
        :class="{ 'bg-gray-300': editor.isActive('heading', { level: 6 }) }"
      >
        <span class="font-extrabold">H6</span>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleBulletList().run()"
        :class="{ 'bg-gray-300': editor.isActive('bulletList') }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M8 4h13v2H8V4zM4.5 6.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 7a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 6.9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM8 11h13v2H8v-2zm0 7h13v2H8v-2z"
          />
        </svg>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleOrderedList().run()"
        :class="{ 'bg-gray-300': editor.isActive('orderedList') }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M8 4h13v2H8V4zM5 3v3h1v1H3V6h1V4H3V3h2zM3 14v-2.5h2V11H3v-1h3v2.5H4v.5h2v1H3zm2 5.5H3v-1h2V18H3v-1h3v4H3v-1h2v-.5zM8 11h13v2H8v-2zm0 7h13v2H8v-2z"
          />
        </svg>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleCodeBlock().run()"
        :class="{ 'bg-gray-300': editor.isActive('codeBlock') }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M4 18v-3.7a1.5 1.5 0 0 0-1.5-1.5H2v-1.6h.5A1.5 1.5 0 0 0 4 9.7V6a3 3 0 0 1 3-3h1v2H7a1 1 0 0 0-1 1v4.1A2 2 0 0 1 4.626 12 2 2 0 0 1 6 13.9V18a1 1 0 0 0 1 1h1v2H7a3 3 0 0 1-3-3zm16-3.7V18a3 3 0 0 1-3 3h-1v-2h1a1 1 0 0 0 1-1v-4.1a2 2 0 0 1 1.374-1.9A2 2 0 0 1 18 10.1V6a1 1 0 0 0-1-1h-1V3h1a3 3 0 0 1 3 3v3.7a1.5 1.5 0 0 0 1.5 1.5h.5v1.6h-.5a1.5 1.5 0 0 0-1.5 1.5z"
          />
        </svg>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().toggleBlockquote().run()"
        :class="{ 'bg-gray-300': editor.isActive('blockquote') }"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179z"
          />
        </svg>
      </button>
      <!-- <button class="rounded bg-white p-1 hover:bg-gray-300" @click="editor.chain().focus().setHorizontalRule().run()">
                horizontal rule
            </button>
            <button class="rounded bg-white p-1 hover:bg-gray-300" @click="editor.chain().focus().setHardBreak().run()">
                hard break
            </button> -->
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().undo().run()"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M8 7v4L2 6l6-5v4h5a8 8 0 1 1 0 16H4v-2h9a6 6 0 1 0 0-12H8z"
          />
        </svg>
      </button>
      <button
        class="rounded bg-white p-1 hover:bg-gray-300"
        @click="editor.chain().focus().redo().run()"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="24"
          height="24"
        >
          <path fill="none" d="M0 0h24v24H0z" />
          <path
            d="M18.172 7H11a6 6 0 1 0 0 12h9v2h-9a8 8 0 1 1 0-16h7.172l-2.536-2.536L17.05 1.05 22 6l-4.95 4.95-1.414-1.414L18.172 7z"
          />
        </svg>
      </button>
    </div>
    <editor-content :editor="editor" class="p-2" />
  </div>
</template>

<script>
import { Editor, EditorContent } from "@tiptap/vue-3";
import Document from "@tiptap/extension-document";
import Paragraph from "@tiptap/extension-paragraph";
import Text from "@tiptap/extension-text";
import { Color } from "@tiptap/extension-color";
import Gapcursor from "@tiptap/extension-gapcursor";
import Heading from "@tiptap/extension-heading";
import Underline from "@tiptap/extension-underline";
import Image from "@tiptap/extension-image";
import Dropcursor from "@tiptap/extension-dropcursor";
import StarterKit from '@tiptap/starter-kit';
import TextStyle from '@tiptap/extension-text-style';
import ListItem from '@tiptap/extension-list-item';
import BulletList from '@tiptap/extension-bullet-list';
import OrderedList from '@tiptap/extension-ordered-list';

export default {
  components: {
    EditorContent,
  },

  props: {
    modelValue: {
      type: String,
      default: "",
    },
  },

  data() {
    return {
      editor: null,
    };
  },

  watch: {
    modelValue(value) {
      const isSame = this.editor.getHTML() === value;

      if (isSame) {
        return;
      }

      this.editor.commands.setContent(value, false);
    },
  },

  mounted() {
    this.editor = new Editor({
      content: this.modelValue,
      extensions: [
        Document,
        Paragraph,
        Text,
        Color,
        Gapcursor,
        Underline,
        StarterKit,
        Heading.configure({
          levels: [1, 2, 3, 4, 5, 6],
        }),
        Image,
        Dropcursor,
        TextStyle,
        BulletList,
        OrderedList,
        ListItem,
      ],
      onUpdate: () => {
        this.$emit("update:modelValue", this.editor.getHTML());
      },
    });
  },

  beforeUnmount() {
    this.editor.destroy();
  },

  methods: {
    addImage() {
      const url = window.prompt("URL");

      if (url) {
        this.editor.chain().focus().setImage({ src: url }).run();
      }
    },
  },
};
</script>



