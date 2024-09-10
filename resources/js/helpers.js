export const isImage = ( attachment ) =>
{
  const mime = attachment.mime || attachment.type
  const attachmentType = mime.split('/')[0].toLowerCase()
  return 'image' === attachmentType
}