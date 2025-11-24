const { addFilter } = wp.hooks;
const { __ } = wp.i18n;

// Extend postStatusesInfo dynamically
addFilter('editor.PostStatus.info', 'glide/add-archived-status-info', (info) => {
    return {
        ...info,
        archived: {
            label: __('Archived', 'archived-post-status'),
            icon: 'archive', // Replace with an appropriate Dashicon or custom SVG if needed
        },
    };
});

// Extend STATUS_OPTIONS dynamically
addFilter('editor.PostStatus.options', 'glide/add-archived-status-option', (options) => {
    return [
        ...options,
        {
            label: __('Archived', 'archived-post-status'),
            value: 'archived',
            description: __('Posts that are no longer active but retained for reference.', 'archived-post-status'),
        },
    ];
});

// const { registerPlugin } = wp.plugins;
// const { PluginPostStatusInfo } = wp.editPost;
// const { Fragment } = wp.element;
// const { __ } = wp.i18n;
// const { select, dispatch } = wp.data;

// const CustomPostStatus = () => {
//     const postStatus = select('core/editor').getEditedPostAttribute('status');
//     const isArchived = postStatus === 'archived';

//     const setPostStatus = () => {
//         dispatch('core/editor').editPost({ status: 'archived' });
//     };

//     return (
//         <PluginPostStatusInfo>
//             <div>
//                 <label>
//                     <input
//                         type="radio"
//                         name="custom-post-status"
//                         checked={isArchived}
//                         onChange={setPostStatus}
//                     />
//                     {__('Archived', 'archived-post-status')}
//                 </label>
//             </div>
//         </PluginPostStatusInfo>
//     );
// };

// registerPlugin('glide-custom-post-status', {
//     render: CustomPostStatus,
// });