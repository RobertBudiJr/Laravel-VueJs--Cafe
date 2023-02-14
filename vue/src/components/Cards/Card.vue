<template>
  <div class="card" :class="[type && `card-${type}`]">
    <div class="card-img-top" v-if="$slots.image">
      <slot name="image"> </slot>
    </div>
    <div
      class="card-header"
      v-if="$slots.header || title"
      :class="headerClasses"
    >
      <slot name="header">
        <img v-if="imageTop" :src="imageTop" alt="" class="card-img-top mb-3" />
        <h4 class="card-title">{{ title }}</h4>
        <div class="row">
          <p class="card-category col-6" v-if="subTitle">{{ subTitle }}</p>
          <p
            class="card-category col-6 text-right text-primary"
            v-if="subTitle2"
          >
            Rp {{ subTitle2 }},00
          </p>
        </div>
      </slot>
    </div>
    <div class="card-body" v-if="$slots.default">
      <slot></slot>
    </div>
    <div class="card-image" v-if="$slots['image-bottom']">
      <slot name="image-bottom"></slot>
    </div>
    <slot name="raw-content"></slot>
    <div class="card-footer" :class="footerClasses" v-if="$slots.footer">
      <slot name="footer">
        <a href="#" v-if="btnEdit" class="btn" :clsass="btnEdit">Edit</a>
        <a href="#" v-if="btnDelete" class="btn" :class="btnDelete">Delete</a>
      </slot>
    </div>
  </div>
</template>
<script>
export default {
  name: "card",
  props: {
    imageTop: {
      type: String,
      description: "Card image top",
    },
    title: {
      type: String,
      description: "Card title",
    },
    subTitle: {
      type: String,
      description: "Card subtitle",
    },
    subTitle2: {
      type: String,
      description: "Card subtitle",
    },
    type: {
      type: String,
      description: "Card type (e.g primary/danger etc)",
    },
    headerClasses: {
      type: [String, Object, Array],
      description: "Card header css classes",
    },
    bodyClasses: {
      type: [String, Object, Array],
      description: "Card body css classes",
    },
    footerClasses: {
      type: [String, Object, Array],
      description: "Card footer css classes",
    },
    btnEdit: {
      type: [String, Object, Array],
      description: "Card button edit",
    },
    btnDelete: {
      type: [String, Object, Array],
      description: "Card button danger",
    },
  },
};
</script>
<style></style>
