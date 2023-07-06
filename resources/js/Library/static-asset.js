export const getStaticAsset = (name) => {
  return import.meta.glob('/resources/images/*', {eager: true})[`/resources/images/${name}`]
    .default;
};
